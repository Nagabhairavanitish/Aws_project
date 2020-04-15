import os, sys

def lambda_handler(event, context):
    dynamodb = boto3.resource('dynamodb')
    table = dynamodb.Table('VehicleInfoDB')
    StatusCode = ['Active','Warning','Danger']
    with table.batch_writer() as batch:
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Kalles Grustransporter AB',
                'VIN': 'YS2R4X20005399401',
                'Reg.no': 'ABC123',
                'Address': 'Cementvägen 8, 111 11 Södertälje',
                'Status': status
            }
        )
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Kalles Grustransporter AB',
                'VIN': 'VLUR4X20009093588',
                'Reg.no': 'DEF456',
                'Address': 'Cementvägen 8, 111 11 Södertälje',
                'Status': status
            }
        )
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Kalles Grustransporter AB',
                'VIN': 'VLUR4X20009048066',
                'Reg.no': 'GHI789',
                'Address': 'Cementvägen 8, 111 11 Södertälje',
                'Status': status
            }
        )
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Johans Bulk AB',
                'VIN': 'YS2R4X20005388011',
                'Reg.no': 'JKL012',
                'Address': 'Balkvägen 12, 222 22 Stockholm',
                'Status': status
            }
        )
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Johans Bulk AB',
                'VIN': 'YS2R4X20005387949',
                'Reg.no': 'MNO345',
                'Address': 'Balkvägen 12, 222 22 Stockholm',
                'Status': status
            }
        )
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Haralds Värdetransporter AB',
                'VIN': 'YS2R4X20005387765',
                'Reg.no': 'PQR678',
                'Address': 'Budgetvägen 1, 333 33 Uppsala',
                'Status': status
            }
        )
        status = random.choice(StatusCode)
        print("random item from list is: ", status)
        batch.put_item(
            Item={
                'Company': 'Haralds Värdetransporter AB',
                'VIN': 'YS2R4X20005387055',
                'Reg.no': 'STU901',
                'Address': 'Budgetvägen 1, 333 33 Uppsala',
                'Status': status
            }
        )