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
    if path =="company/haralds-vardetransporter-ab" && method =="Get":
        response = table.scan(  FilterExpression= Key('Company').eq("Haralds Värdetransporter AB"))
    elif path == "company/kalles-grustransporter-ab" && method =="Get":
        response = table.scan(  FilterExpression= Key('Company').eq("Kalles Grustransporter AB"))
    elif path == "company/johans-bulk-ab" && method =="Get":
        response = table.scan(  FilterExpression= Key('Company').eq("Johans Bulk AB"))
    
    items = response['Items']

    print(items)
    return {
        "statusCode": 200,
        "body": json.dumps(items)
    }