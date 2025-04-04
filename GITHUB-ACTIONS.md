# Github Actions

[The best course here](https://www.youtube.com/playlist?list=PLiO7XHcmTsleVSRaY7doSfZryYWMkMOxB)  
[The template repo here](https://github.com/devopselvis/my-github-actions-presentation/tree/main/.github/workflows)

## 1. Basic workflow

```yml
# This is a basic workflow that is manually triggered

# Display name of workflow
name: Basic Workflow

# Controls when the action will run. Workflow runs when manually triggered using the UI or API.
on:
  workflow_dispatch: #trigger the workflow manually
    # Inputs the workflow accepts.
    inputs:
      name:
        # Friendly description to be shown in the UI instead of 'name'
        description: "Who are you ?"
        # Default value if no value is explicitly provided
        default: "Pierre"
        # Input has to be provided for the workflow to run
        required: true
        # Input Type (string, choice, boolean)
        type: string
      country:
        description: "Where do you live ?"
        required: true
        default: "France"
        type: choice #create a menu
        options:
          - France
          - Belgium
          - Luxembourg
          - Switzerland
          - Elsewhere
      real-human:
        description: "I'm a real human"
        required: true
        type: boolean #create a checkbox, true if checked

# A workflow run is made up of one or more jobs that can run sequentially or by defaut in parallel
jobs:
  # This workflow contains a single job called "greet"
  greet:
    # Display name for the job
    name: "Greetings, Program!"

    # The type of runner that the job will run on, in this case a Linus hosted runner
    runs-on:
      - ubuntu-latest

    # Steps represent a sequence of tasks that will be executed as part of the job
    steps:
      # Runs command(s) using the runners shell and gets context from the github object
      - name: Send greeting
        # the pipe indicates a command on multiple lines
        run: |
          echo "Hello ${{ github.event.inputs.name }}" 
          echo "Your country is ${{ github.event.inputs.country }}"
          echo "Are you human ? ${{ github.event.inputs.real-human }}"
        # Hello Pierre. Your country is France. Are you human ? true
      - name: Checkout the code with a github actions
        uses: actions/checkout@v4 #found in the marketplace (https://github.com/marketplace/actions/checkout)
```

## 2. Chaining jobs

```yml
name: Chaining Jobs

on:
  workflow_dispatch:
    inputs:
      run-job-3:
        description: "Run job 3"
        required: true
        type: boolean

jobs:
  job-1:
    name: Job 1
    runs-on: ubuntu-latest
    steps:
      - name: Output for Job 1
        run: echo "Hello from Job 1. Run Job 3 equals ${{ github.event.inputs.run-job-3 }}"

  job-2:
    name: Job 2
    runs-on: ubuntu-latest
    needs: # will run only after job-1 succeeds, not in parallel
      - job-1
    steps:
      - name: Output for Job 2
        run: echo "Hello from Job 2"
      # - name: Make Job 2 Fail
      #   run: exit 1

  job-3:
    name: Job 3
    if: github.event.inputs.run-job-3 == 'true'
    runs-on: ubuntu-latest
    needs:
      - job-1
    steps:
      - name: Output for Job 3
        run: echo "Hello from Job 3"

  job-4:
    name: Job 4
    runs-on: ubuntu-latest
    # if: always() #the test job will run even if the prerequisite jobs fails
    needs: #if job-2 or job-3 fails, job-4 will not run. With if: always() it will run
      - job-2
      - job-3
    steps:
      - name: Output for Job 4
        run: echo "Hello from Job 4"
```

## 3. Github context object and variables

```yml
# I am a workflow that demonstrates how to output the different context objects

name: Variables and Context

on:
  workflow_dispatch:
    inputs:
      name:
        description: "Person to greet"
        default: "World"
        required: true

env: #global variables here, available for the entire workflow
  VAR1: myworkflowvar1
  VAR2: myworkflowvar2
  VAR3: myworkflowvar3

jobs:
  job1:
    runs-on: ubuntu-latest
    steps:
      - name: Dump GitHub context
        env:
          GITHUB_CONTEXT: ${{ toJSON(github) }}
        run: echo "$GITHUB_CONTEXT"
        # ./items/annexGHActions/Github_context.yml

  #step/job output variables
  job2:
    runs-on: ubuntu-latest

    outputs: #outputs defined here will be available in other jobs
      output1: ${{ steps.step1.outputs.step1value }} #hello
      output2: ${{ steps.step2.outputs.step2value }} #world

    steps:
      - name: Step 1
        id: step1 #reference for the output
        # run: echo "::set-output name=step1value::hello"
        run: echo "step1value=hello" >> $GITHUB_OUTPUT
        # step1value is added to the github output

      - name: Step 2
        id: step2
        # run: echo "::set-output name=step2value::world"
        run: echo "step2value=world" >> $GITHUB_OUTPUT

  job3:
    runs-on: ubuntu-latest
    needs: job2
    steps:
      - run: echo ${{needs.job2.outputs.output1}} ${{needs.job2.outputs.output2}}
        # hello world

  # access/set env variables
  job4:
    runs-on: ubuntu-latest
    env: #variables here are only available for this job
      VAR2: myjobvar2 #override the global env workflow variable
      VAR3: myjobvar3
    steps:
      - run: |
          echo $VAR1
          echo ${{env.VAR1}}
          echo ""
          echo $VAR2
          echo $VAR3
        # myworkflowvar1, myworkflowvar1, myjobvar2, mystepvar3
        env: #variables here are only available for this step
          VAR3: mystepvar3 #override the global env workflow and job variable
```

## 4. Pull request workflow with a markdown report

```yml
name: PR - Build / Test

on:
  pull_request:
    branches:
      - main
  workflow_dispatch:
  # the workflow can be triggered manually when a pull request is made on the main branch

jobs:
  build-and-test:
    runs-on: ubuntu-latest

    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Setup .NET Core
        uses: actions/setup-dotnet@v4.1.0
        with: # extra parameters
          dotnet-version: "8.0.x"

      - name: Restore dependencies
        run: dotnet restore "${{github.workspace}}/src/my-web-app.sln"

      - name: Build
        run: dotnet build "${{github.workspace}}/src/my-web-app.sln"  --no-restore --configuration Release

      - name: Test
        run: dotnet test "${{github.workspace}}/src/my-web-app.sln" --no-restore --logger:"junit;LogFilePath=${{ github.workspace }}/results/test-results.xml"
        # the test results will be stored in an xml file

      # Create a test summary markdown file
      # If you don't specify an output file, it will automatically add as a job summary.
      # If you specify an output file, you have to create your own step of adding it to the job summary.
      # I am intentionally doing that to show job summaries.
      - name: Create markdown test summary from the xml report
        uses: test-summary/action@v2.4 #https://github.com/marketplace/actions/testforest-dashboard
        with:
          paths: ${{ github.workspace }}/results/*.xml
          output: ${{ github.workspace }}/results/summary.md
          show: "all"
        if: always() #this step will run even if the previous steps fails

      # I am adding the test results to the Job Summary
      - name: Add Test Results To Job Summary
        run: |
          echo "TEST RESULTS:" >> $GITHUB_STEP_SUMMARY
          echo "" >> $GITHUB_STEP_SUMMARY # this is a blank line
          cat "${{ github.workspace }}/results/summary.md" >> $GITHUB_STEP_SUMMARY
        if: always()

      - name: Publish the file as an artifact in mywebapp folder
        run: dotnet publish "${{github.workspace}}/src/my-web-app/my-web-app.csproj" -c Release -o mywebapp

      - name: Upload build artifact in the workflow
        uses: actions/upload-artifact@v4
        with:
          name: myapp
          path: mywebapp/**
          if-no-files-found: error
```

## 5. Deploy workflow

Best practices before deployment:

- Protect the main branch from the push (only pull request accepted)
- Build and test on the dev branch
- Create a pull request to merge on the main branch
- Build and test on the main branch
- If all tests are ok, deploy on the dev and then the staging environment
- Deploy on the production environment manually with a review

```yml
name: Deploy

on:
  push:
    branches:
      - main
  workflow_dispatch:

permissions: #from the documentation of OICD
  id-token: write
  contents: read

jobs:
  deploy-to-dev:
    runs-on: ubuntu-latest
    needs: build-and-test
    environment:
      name: DEV
      url: http://my-web-app-please-work-dev.azurewebsites.net/

    steps:
      - name: Download artifact
        uses: actions/download-artifact@v4
        with:
          name: myapp
          path: myapp

      - name: Prove to myself the files are there
        run: |
          ls -la
          ls -la myapp

      - name: Login to Azure
        uses: azure/login@v2.2.0
        with:
          client-id: ${{ secrets.AZURE_CLIENT_ID }} #set in the github actions secrets
          tenant-id: ${{ secrets.AZURE_TENANT_ID }}
          subscription-id: ${{ secrets.AZURE_SUBSCRIPTION_ID }}

      - name: Deploy to Azure Web App
        uses: azure/webapps-deploy@v3
        with:
          app-name: ${{ vars.WEB_APP_NAME }} #set in the github actions variables
          slot-name: dev
          package: myapp #the artifact to deploy

  deploy-to-staging:
    runs-on: ubuntu-latest
    needs: build-and-test
    environment:
      name: STAGING
      url: http://my-web-app-please-work-staging.azurewebsites.net/

    steps:
      - name: Download artifact
        uses: actions/download-artifact@v4
        with:
          name: myapp
          path: myapp

      - name: Login to Azure
        uses: azure/login@v2.2.0
        with:
          client-id: ${{ secrets.AZURE_CLIENT_ID }}
          tenant-id: ${{ secrets.AZURE_TENANT_ID }}
          subscription-id: ${{ secrets.AZURE_SUBSCRIPTION_ID }}

      - name: Deploy to Azure Web App
        uses: azure/webapps-deploy@v3
        with:
          app-name: ${{ vars.WEB_APP_NAME }}
          slot-name: staging
          package: myapp

  # Set in the PROD environment options, a review must be accepted manually to run the job
  deploy-to-prod:
    runs-on: ubuntu-latest
    needs:
      - deploy-to-dev
      - deploy-to-staging
    environment:
      name: PROD
      url: http://my-web-app-please-work-prod.azurewebsites.net/

    steps:
      - name: Download artifact
        uses: actions/download-artifact@v4
        with:
          name: myapp
          path: myapp

      - name: Login to Azure
        uses: azure/login@v2.2.0
        with:
          client-id: ${{ secrets.AZURE_CLIENT_ID }}
          tenant-id: ${{ secrets.AZURE_TENANT_ID }}
          subscription-id: ${{ secrets.AZURE_SUBSCRIPTION_ID }}

      - name: Deploy to Azure Web App
        uses: azure/webapps-deploy@v3
        with:
          app-name: ${{ vars.WEB_APP_NAME }}
          slot-name: prod
          package: myapp
```

## 6. Custom actions and reusable workflows

### Create a custom action (in another repo)

We can create a custom workflow of the build-and-test job in another repo to avoid repeating the same code.
3 types of custom actions:

- Javascript or Typescript file (more powerful)
- Action inside a docker container with every language possible (slowest and only on linux runner)
- Composite action (list of steps called from another repo with a action.yml file)

With a custom action we can't use secrets or variables from the repo

_devopselvis/build-test-net-core-app-custom-action/action.yml_

```yml
name: "Build and Publish .NET Core App"
description: "Composite action to build and publish a .NET Core application"
inputs: #the parameters the user will have to provide
  dotnet-version:
    description: "The version of .NET Core to use"
    required: true
  project-path:
    description: "The path to the .NET Core project file"
    required: true
  output-path:
    description: "The output path for the published application"
    required: true
outputs:
  artifact-path:
    description: "The path to the build artifact"

runs: # /!\ not jobs
  using: "composite" #type of custom action
  steps: #same code as the build-and-test job, but with the inputs required
    - name: Checkout code
      uses: actions/checkout@v4

    - name: Setup .NET Core
      uses: actions/setup-dotnet@v4.1.0
      with:
        dotnet-version: ${{ inputs.dotnet-version }}

    - name: Restore dependencies
      run: dotnet restore "${{ inputs.project-path }}"
      shell: bash

    - name: Build
      run: dotnet build "${{ inputs.project-path }}" --no-restore --configuration Release
      shell: bash

    - name: Publish
      run: dotnet publish "${{ inputs.project-path }}" -c Release -o ${{ inputs.output-path }}
      shell: bash

    - name: Upload build artifact
      uses: actions/upload-artifact@v4
      with:
        name: myapp
        path: ${{ inputs.output-path }}/**
        if-no-files-found: error
```

### Create a reusable workflow (in the same repo)

The yml file must be placed in the same .github/workflows folder.
_devopselvis/my-github-actions-presentation/.github/workflows/deploy-to-environment-reusable.yml_
We can use here secrets or variables.

```yml
name: Deploy to Environment

on:
  workflow_call: #this is a reusable workflow
    inputs: #the parameters the user will have to provide
      environment-name:
        description: "The name of the environment (e.g., DEV, STAGING, PROD)"
        required: true
        type: string
      environment-url:
        description: "The URL of the environment"
        required: true
        type: string
      artifact-name:
        description: "The name of the artifact to download"
        required: true
        type: string
      web-app-name:
        description: "The name of the Azure Web App"
        required: true
        type: string
        default: ${{ vars.WEB_APP_NAME }}
      slot-name:
        description: "The slot name for the Azure Web App"
        required: true
        type: string

jobs:
  deploy:
    runs-on: ubuntu-latest
    environment:
      name: ${{ inputs.environment-name }}
      url: ${{ inputs.environment-url }}

    steps:
      - name: Download artifact
        uses: actions/download-artifact@v4
        with:
          name: ${{ inputs.artifact-name }}
          path: myapp

      - name: Login to Azure
        uses: azure/login@v2.2.0
        with:
          client-id: ${{ secrets.AZURE_CLIENT_ID }}
          tenant-id: ${{ secrets.AZURE_TENANT_ID }}
          subscription-id: ${{ secrets.AZURE_SUBSCRIPTION_ID }}

      - name: Deploy to Azure Web App
        uses: azure/webapps-deploy@v3
        with:
          app-name: ${{ inputs.web-app-name }}
          slot-name: ${{ inputs.slot-name }}
          package: myapp
```

### Implement them in a workflow

```yml
name: Deploy

on:
  push:
    branches:
      - main
  workflow_dispatch:

permissions: #from the documentation of OICD
  id-token: write
  contents: read

jobs:
  build-and-test: #with the custom action
    runs-on: ubuntu-latest
    steps:
      - name: Before Composite action
        run: |
          echo "Hello from before composite action"

      - name: Build and Publish .NET Core App
        #import the action.yml from another repo
        uses: devopselvis/build-test-net-core-app-custom-action@main
        with: #the inputs parameters must be provided here
          dotnet-version: "8.0.x"
          project-path: "${{ github.workspace }}/src/my-web-app/my-web-app.csproj"
          output-path: "mywebapp"

      - name: After Composite action
        run: |
          echo "Hello from after composite action"

  deploy-to-dev: #use the reusable workflow from the same repo
    needs: build-and-test
    uses: devopselvis/my-github-actions-presentation/.github/workflows/deploy-to-environment-reusable.yml@main
    with:
      environment-name: "DEV"
      environment-url: "http://my-web-app-please-work-dev.azurewebsites.net/"
      artifact-name: "myapp"
      web-app-name: ${{ vars.WEB_APP_NAME }}
      slot-name: "dev"
    secrets: inherit #to give access of the secrets of this repo

  deploy-to-staging:
    needs: build-and-test
    uses: devopselvis/my-github-actions-presentation/.github/workflows/deploy-to-environment-reusable.yml@main
    with:
      environment-name: "STAGING"
      environment-url: "http://my-web-app-please-work-staging.azurewebsites.net/"
      artifact-name: "myapp"
      web-app-name: ${{ vars.WEB_APP_NAME }}
      slot-name: "staging"
    secrets: inherit

  deploy-to-prod:
    needs:
      - deploy-to-staging
      - deploy-to-dev
    uses: devopselvis/my-github-actions-presentation/.github/workflows/deploy-to-environment-reusable.yml@main
    with:
      environment-name: "PROD"
      environment-url: "http://my-web-app-please-work-prod.azurewebsites.net/"
      artifact-name: "myapp"
      web-app-name: ${{ vars.WEB_APP_NAME }}
      slot-name: "prod"
    secrets: inherit
```

## 7. Custom events

```yml
name: Repository Dispatch Example

on:
  repository_dispatch:
    types: [on-demand-test-event] #name of the custom event

jobs:
  get-info-from-event:
    runs-on:
      - ubuntu-latest

    steps:
      - name: Dump GitHub context
        env:
          GITHUB_CONTEXT: ${{ toJSON(github) }}
        run: echo "$GITHUB_CONTEXT"

      - name: Send greeting
        run: |
          echo "value1: ${{github.event.client_payload.value1}}" 
          echo "value2: ${{github.event.client_payload.value2}}" 
          echo "value3: ${{github.event.client_payload.value3}}"
```

To trigger the workflow, we need to send a post request to the GitHub API, using cURL, JavaScript or Github CLI.
See [the docs here](https://docs.github.com/en/rest/repos/repos?apiVersion=2022-11-28#create-a-repository-dispatch-event)  
**event_type** will trigger the workflow and the client_payload values will be passed in the github context.

```bash
gh api \
  --method POST \
  -H "Accept: application/vnd.github+json" \
  -H "X-GitHub-Api-Version: 2022-11-28" \
  /repos/devopselvis/my-github-actions-presentation/dispatches \
   -f "event_type=on-demand-test-event" -F "client_payload[value1]=true" -F "client_payload[value2]=42 42" -F "client_payload[value3]=DevOps rocks"
```

## 8. Masking variables and secrets

```yml
name: Masking Variables

# Controls when the action will run. Workflow runs when manually triggered using the UI or API.
on:
  workflow_dispatch:

jobs:
  # Simple Example: Mask a string in the logs
  demo-basic-masking:
    runs-on: ubuntu-latest
    steps:
      - name: Mask a simple string
        run: |
          echo "::add-mask::SuperSecretPassword123"
          echo "This is my password: SuperSecretPassword123"

  # Mask an environment variable
  demo-env-var-masking:
    runs-on: ubuntu-latest
    env:
      MY_SECRET: "TopSecretValue"
    steps:
      - name: Mask an environment variable
        run: |
          echo "::add-mask::$MY_SECRET"
          echo "The secret value is: $MY_SECRET"

  # Dynamic Masking: mask in one step and use in a different step
  demo-dynamic-masking:
    runs-on: ubuntu-latest
    steps:
      - name: Generate and mask a dynamic secret
        id: secret-step
        run: |
          DYNAMIC_SECRET=$(openssl rand -hex 16)
          echo "::add-mask::$DYNAMIC_SECRET"
          echo "generated-secret=$DYNAMIC_SECRET" >> $GITHUB_OUTPUT
      - name: Use the masked secret
        run: echo "The secret is ${{ steps.secret-step.outputs.generated-secret }}"

  # Masking a multi-line value
  demo-multiline-masking:
    runs-on: ubuntu-latest
    steps:
      - name: Mask a multi-line value
        run: |
          MULTILINE_SECRET="Line 1
          Line 2
          Line 3"
          echo "$MULTILINE_SECRET" | while IFS= read -r line; do
            echo "::add-mask::$line"
          done
          echo "The multi-line secret is:"
          echo "$MULTILINE_SECRET"
```
