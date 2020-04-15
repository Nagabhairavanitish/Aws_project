Implementation: The implementation of the task is performed in AWS.
Requirements: This entire task is implemented in Amazon Cloud service free tier account with complete cost efficient services.
Services used are.
1. AWS lamda (3) 
2. cloud watch event
3. SNS topic.
4. API gateway.
5. S3 bucket
6. Dynamo DB
7. Static hosting from S3 bucket
8. IAM
9. CloudWatch Logs




Why I feel that this Architecture is well suited for the solution:

1. Since Lamba is a service that allows you to run your functions in the cloud entirely serverless and eliminates the operational complexity. So through lambda we can build microservice
2. Cloud watch Events is a service which constantly triggers the lambda through this service we can modify the dynamodb for every one minute to change the status of the vehicle.
3. Through IAM  policies we can secure access to aws resources. In our case, especially for API endpoint, the authorization is enabled using AWS_IAM. Where only certain users with the right policy can access the url.
4. SNS service is an easy to configure messaging platform. Any desired change in the table will push a notification to the subscribers of the topic.
5. CloudWatch Logs provides a way to monitor, analyze and query the logs from the lambda function with no special infrastructure.
 
Setup:

The entire architecture is divided into three parts:
1. Randomiser
2. Notifier
3. Website

1. Randomiser:
First, I have created a basic lambda function with Python3.8 as runtime using the AWS console. The purpose of this lambda function is to populate the database with the table information provided from the assignment as a batch. This lambda function is built using the boto3 SDK. Here in order to change the status frequently I used random function to modify the status which would choose randomly from (Active, warning, danger). In the database,
Primary partition key
Company (String)
Primary sort key
VIN (String)

Trigger: Cloud watch event 
With the help of CloudWatch Events, I have used a ‘Rate Expression’ to configure an event which will trigger the lambda every 1 minute.
Ex: rate(1 minute)

IAM policies attached to the Lambda role: AWSLambdaBasicExecutionRole, DynamoDB: BatchWriteItem, PutItem, UpdateItem.
Logging: CloudWatch
All the basic and error logging is done in CloudWatch Logs

2. Notifier:
The above DynamoDB table has streams enabled. So, whenever there is a change in the DynamoDB table it with generate ‘DynamoDB streams’. The stream type is ‘New image’ This stream acts as a trigger for the ‘WriteToSnsTopicLambda’ lambda.  
The Function of this Lambda is read the output of DynamoDB streams and write a message on SNS topic accordingly. Fig.5 shows an example of the message sent to a subscriber of the SNS topic.

Runtime: Node.js 1.2x

IAM policies attached to the Lambda role: AWSLambdaBasicExecutionRole, DynamoDB: BatchGetItem,DescribeStream, GetItem, GetShardIterator, SNS: Publish.

Logging: CloudWatch
All the basic and error logging is done in CloudWatch Logs

3. Website

Front End of the website is achieved by using simple HTML,CSS,Jquery, Ajax and php. For accessing the frontend we need to install xampp and create a folder in the htdocs. In order to render the front end we need to open xampp control panel and start the apache server, the URL for the website is http://localhost/assignment/vechicles.php
Implementation is to create a GUI where I can display the Information in the DynamoDB table and make queries.
First, I have created an API gateway and created a resource ‘/vin’ with a Get method. This method is integrated with the lambda function ‘VehicleInfoLambda’. So, Whenever this endpoint is called this lambda function is triggered.
This lambda function’s purpose is to respond with the status code and the output of Scan the whole DynamoDB table.
A stage has been created to access the url which will invoke the lambda function.
Without Authorization:
	  InvokeURL:https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/statusAction/vin
With Authorization
 Invoke URL: https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/Authorized

Authorization: AWS_IAM
The endpoint is secured using AWS_IAM authorization type. A ‘Guest’ IAM_User has been created with ‘AmazonAPIGatewayInvokeFullAccess’ policy. The ‘credentials.csv’ file has been attached to the email.
Note: This guest user has only access to invoke the api gateway.
Integration Type: LAMBDA_PROXY
Runtime: Python 3.8
IAM policies attached to the Lambda role: AWSLambdaBasicExecutionRole, DynamoDB: Scan,Query, GetShardIterator.

Logging: CloudWatch
All the basic and error logging is done in CloudWatch Logs

GET method API for each action:  In this task we created a drop down box to display details based on the status (Active, Warning, Danger). When we select Active we can access all the active elements from our Dynamodb.

In the same way we created for  Warning and Danger as well.

We created a search button and space to search and filter the elements on the basis of their Company name. We also created an GET-APi endpoint for this task. We can render the elements on the basis of name 


1. Able to design a microservice and an architecture for this task
2. Able to secure the API through IAM policies
3. Deployment Instruction and easy deployment scripts
4. Read me to Illustrate why this architecture is better for the solution
5. Logging
6. Messaging platform(SNS service)
7. API endpoint with status code:200 and json dump of the table

Improvements:
 
IOT Device simulator: The IoT Device Simulator is a solution that enables customers to create and simulate hundreds of virtual connected devices, without having to configure and manage physical devices, or develop time-consuming scripts. The solution also includes a pre-built automotive module that you can use to simulate vehicle telemetry data using predefined device types.

Cloud formation: These services are designed to complement each other. AWS Elastic Beanstalk provides an environment to easily deploy and run applications in the cloud. It is integrated with developer tools and provides a one-stop experience for you to manage the lifecycle of your applications. AWS CloudFormation is a convenient provisioning mechanism for a broad range of AWS and third party resources.

 
Amazon Cognito Federated Identities: Amazon Cognito Federated Identities is a web service that delivers scoped temporary credentials to mobile devices and other untrusted environments. It uniquely identifies a device and supplies the user with a consistent identity over the lifetime of an application.
Using Amazon Cognito Federated Identities, you can enable authentication with one or more third-party identity providers (Facebook, Google, or Login with Amazon) or an Amazon Cognito user pool, and you can also choose to support unauthenticated access from your app. Cognito delivers a unique identifier for each user and acts as an OpenID token provider trusted by AWS Security Token Service (STS) to access temporary, limited-privilege AWS credentials.

