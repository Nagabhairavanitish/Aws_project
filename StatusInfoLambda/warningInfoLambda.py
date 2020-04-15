import boto3
import json
import os, sys
import logging
logger = logging.getLogger()
logger.setLevel(logging.INFO)


def lambda_handler(event, context):
    # TODO implement
    from boto3.dynamodb.conditions import Key, Attr

    dynamodb = boto3.resource('dynamodb')
    table = dynamodb.Table('VehicleInfoDB')
    response = table.scan( FilterExpression = Attr('Status').eq('Warning'))

    items = response['Items']

    print(items)
    return {
        "statusCode": 200,
        "body": json.dumps(items)
    }