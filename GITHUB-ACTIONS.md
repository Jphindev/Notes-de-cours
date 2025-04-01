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
  build:
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
      - name: Create test summary
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

      - name: Publish
        run: dotnet publish "${{github.workspace}}/src/my-web-app/my-web-app.csproj" -c Release -o mywebapp

      - name: Upload build artifact
        uses: actions/upload-artifact@v4
        with:
          name: myapp
          path: mywebapp/**
          if-no-files-found: error
```
