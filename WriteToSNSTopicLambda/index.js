'use strict';
var AWS = require("aws-sdk");
var sns = new AWS.SNS();

exports.handler = (event, context, callback) => {

    event.Records.forEach((record) => {
        console.log('Stream record: ', JSON.stringify(record, null, 2));
        
        if (record.eventName == 'MODIFY') {
            var Company = JSON.stringify(record.dynamodb.NewImage.Company.S);
            var VIN = JSON.stringify(record.dynamodb.NewImage.VIN.S);
            var Status = JSON.stringify(record.dynamodb.NewImage.Status.S);
            var params = {
                Subject: 'Company: ' + Company, 
                Message: 'The status of the vehicle with VIN ' + VIN + 'is ' + Status + 'which is under the company' + Company,
                TopicArn: 'arn:aws:sns:eu-west-1:115069307624:dynamodb'
            };
            sns.publish(params, function(err, data) {
                if (err) {
                    console.error("Unable to send message. Error JSON:", JSON.stringify(err, null, 2));
                } else {
                    console.log("Results from sending message: ", JSON.stringify(data, null, 2));
                }
            });
        }
    });
    callback(null, `Successfully processed ${event.Records.length} records.`);
};   