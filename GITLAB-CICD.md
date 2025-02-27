# GITLAB CI/CD

If the main branch is protected on Gitlab (recommanded):

- For each functionality added, creation of a new branch and push on the gitlab repository.
- Merge of the feature branch with the main branch by creating a merge request.
- Resolving the merge request is possible if the pipeline succeeds.

## MY FIRST PIPELINE

```yml
variables:
  BUILD_FILE_NAME: laptop.txt #global variables

build laptop: #job name (a dot before the name to disable the job)
  image: alpine #light linux image
  stage: build
  #variables: #we can declare local variables here
  #  build_file_name: laptop.txt
  script: #a list of scripts to execute
    #- build_file_name=laptop.txt #we can also declare the variable here
    - echo "Building a laptop"
    - mkdir build
    - touch build/$BUILD_FILE_NAME #no need to write this, the file will be created with the next line
    - echo "Mainboard" >> build/$BUILD_FILE_NAME #redirection operator
    - cat build/$BUILD_FILE_NAME
    - echo "Keyboard" >> build/$BUILD_FILE_NAME
    - cat build/computer.txt
  artifacts:
    paths:
      - build #the build job will be saved for the following jobs

test laptop:
  image: alpine
  stage: test #test by default, no need to write this
  script:
    - test -f build/$BUILD_FILE_NAME #verify if the file exists
    #the test will fail because the file created in the previous job will be deleted with its container before doing the test job, that's why we have to use artifacts to save it
    - grep "Mainboard" build/$BUILD_FILE_NAME #check if the string is in the file
    - grep "Keyboard" build/$BUILD_FILE_NAME
```

## FREE CODE CAMP COURSE GITLAB CI/CD

```yml
stages:
  - .pre #is running before everything else
  - build #to build the project in a docker image
  - test #to run unit tests
  - deploy staging #to deploy the project in a staging environment before going to production
  - test staging #to test the project in a staging environment
  - deploy production #to deploy the project in a production environment
  - test production #to see if the deployment was successful

#the stages list is here to execute the jobs one after the other and not at the same time

variables:
  APP_BASE_URL: http://freecodecamp-course.s3-website.eu-west-3.amazonaws.com/
  APP_BASE_URL_STAGING: http://freecodecamp-course-staging.s3-website.eu-west-3.amazonaws.com/
  #it is recommanded to set these url variables in the gitlab environments options
  APP_VERSION: $CI_PIPELINE_IID #Internal ID to verify if this is the right version that's being deployed
  #The $CI_ variables can be found in the gitlab CI/CD variables docs
```

### CONTINUOUS INTEGRATION

```yml
build website:
  image: node:22-alpine #takes less place than node:22 (see docker hub tags)
  stage: build
  script:
    - yarn install
    - yarn lint #instead of the linter job
    - yarn test #instead of the unit tests job
    - yarn build
    - echo $APP_VERSION > build/version.html #to check later the version of the project
  artifacts:
    paths:
      - build

test website:
  image: node:22-alpine
  stage: test
  script:
    - test -f build/index.html
    - yarn global add serve
    - apk add curl #alpine package manager to install curl
    - serve -s build & #start the server in the background to allow the next step
    - sleep 10 #during 10 seconds
    - curl http://localhost:3000 | grep "React App" #the localhost is launched in a curl to simulate it
```

### CONTINUOUS DEPLOYMENT

```yml
.deploy: #to avoid repeating code, a dot job can be called from another job
  image:
    name: amazon/aws-cli:2.24.7 #find version with docker hub
    entrypoint: [""]
  rules:
    - if: $CI_COMMIT_REF_NAME == $CI_DEFAULT_BRANCH #deployment occurs only if the tested branch is the main branch
  script:
    - aws --version
    - echo $CI_COMMIT_REF_NAME #to see the name of the branch
    - echo "Hello S3" > test.txt #insert a text into a file
    - aws s3 cp test.txt s3://$AWS_S3_BUCKET/test.txt #copy the file to the s3 bucket using the variable created in gitlab settings
    - aws s3 sync build s3://$AWS_S3_BUCKET --delete
    #to sync an entire folder and delete the files that don't match the folder
    #the correct environment must be affected to this variable on gitlab
    - curl $APP_BASE_URL_STAGING | grep "React App" #when using the global variable
    #to verify if the site is still working after the deployment
    - curl $CI_ENVIRONMENT_URL | grep "React App" #using here the url of the gitlab staging environment variable
    #putting the staging test here to simplify the code and avoiding a staging tests job
    - curl $CI_ENVIRONMENT_URL/version.html | grep $APP_VERSION #verifying the version

deploy to staging: #using aws s3 cloud storage
  stage: deploy staging
  environment: staging #defined in the environments options on gitlab
  #The environment must be specified here to get the right AWS_S3_BUCKET variable
  extends: .deploy #here goes all the .deploy code
```

The script will work after adding a user IAM (gitlab) with an access key to the CLI in the aws account and configuring these settings in gitlab CI/CD variables options:

- AWS_ACCESS_KEY_ID (obtained from the IAM user)
- AWS_SECRET_ACCESS_KEY (must be masked)
- AWS_DEFAULT_REGION (eu-west-3)

#### Hosting a website on aws S3

- files in the S3 bucket are not publicly available
- to get the website to work, we need to configure the bucket
- from the bucket, click on Properties and enable Static website hosting
- from the bucket, click on the Permissions tab and disable Block public access
- from the bucket, click on the Permissions tab and set a bucket policy

**bucket policy example**

```json
{
	"Version": "2012-10-17",
	"Statement": [
		{
			"Sid": "PublicRead",
			"Effect": "Allow",
			"Principal": "*",
			"Action": "s3:GetObject",
			"Resource": "arn:aws:s3:::freecodecamp-course/*"
		}
	]
}
```

### CONTINUOUS DELIVERY

With the continuous production, all deployments (staging and production) are automatic.  
With the continuous delivery, the production deployment is triggered manually.

```yml
deploy to production:
  stage: deploy production
  when: manual #for a manually production deployment (continuous delivery)
  environment: production
  extends: .deploy
```

## CI/CD WITH DOCKER

```yml
stages:
  - build
  - package
  - test
  - deploy

variables:
  APP_VERSION: $CI_PIPELINE_IID

build website:
  image: node:22-alpine
  stage: build
  script:
    - yarn install
    - yarn lint
    - yarn test
    - yarn build
    - echo $APP_VERSION > build/version.html
  artifacts:
    paths:
      - build

build docker image:
  stage: package
  image: docker:28.0.0 #for the client part
  services:
    - docker:28.0.0-dind #docker in docker for the server part
  script:
    #building docker image into the gitlab private container registry
    - echo $CI_REGISTRY_PASSWORD | docker login -u $CI_REGISTRY_USER $CI_REGISTRY --password-stdin
    #using temporary gitlab container registry credentials to log into the registry
    # -u -> user
    #stdin -> standrd input to get the password more securely
    - docker build -t $CI_REGISTRY_IMAGE -t $CI_REGISTRY_IMAGE:$APP_VERSION .
    # -t -> to give the image a tag
    # two tags are created here from right to left: one with the version number and one with the latest version name
    # . -> build in the current folder
    - docker image ls
    - docker push --all-tags $CI_REGISTRY_IMAGE

test docker image:
  stage: test
  image: alpine/curl:8.12.1
  services:
    - name: $CI_REGISTRY_IMAGE:$APP_VERSION #docker image used
      alias: website
  script:
    - curl http://website/version.html | grep $APP_VERSION

deploy to production:
  stage: deploy
  variables:
    APP_NAME: freeCodeCamp EB #name of the elastic beanstalk application
    APP_ENV_NAME: FreeCodeCampEB-env #name of the elastic beanstalk environment
  image:
    name: amazon/aws-cli:2.24.7
    entrypoint: [""]
  environment: production
  script:
    - aws --version
    - export DEPLOY_TOKEN=$(echo $GITLAB_DEPLOY_TOKEN | tr -d "\n" | base64)
    # base64 is used to convert the deploy token to base64
    # tr -d "\n" is used to remove the new line character
    - yum install -y gettext #to install envsubst
    - envsubst < templates/Dockerrun.aws.json > Dockerrun.aws.json
    - envsubst < templates/auth.json > auth.json
    # envsubst is used to replace the variables with their right value
    - cat Dockerrun.aws.json
    - cat auth.json
    - aws s3 cp Dockerrun.aws.json s3://$AWS_S3_BUCKET/Dockerrun.aws.json
    - aws s3 cp auth.json s3://$AWS_S3_BUCKET/auth.json
    # all variables inside the json files must be configured in gitlab
    - aws elasticbeanstalk create-application-version --application-name "$APP_NAME" --version-label $APP_VERSION --source-bundle S3Bucket=$AWS_S3_BUCKET,S3Key=Dockerrun.aws.json
    - aws elasticbeanstalk update-environment --application-name "$APP_NAME" --version-label $APP_VERSION --environment-name $APP_ENV_NAME
    - aws elasticbeanstalk wait environment-updated --application-name "$APP_NAME" --version-label $APP_VERSION --environment-name $APP_ENV_NAME
    - curl $CI_ENVIRONMENT_URL/version.html | grep $APP_VERSION
```

**Dockerrun.aws.json**

```json
{
	"AWSEBDockerrunVersion": "1",

	"Image": {
		"Name": "$CI_REGISTRY_IMAGE:$APP_VERSION"
	},

	"Authentication": {
		"Bucket": "$AWS_S3_BUCKET",

		"Key": "auth.json"
	},

	"Ports": [
		{
			"ContainerPort": 80
		}
	]
}
```

**auth.json**

```json
{
	"auths": {
		"$CI_REGISTRY": {
			"auth": "$DEPLOY_TOKEN"
		}
	}
}
```
