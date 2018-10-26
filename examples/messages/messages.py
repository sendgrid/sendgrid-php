import sendgrid
import json
import os
 sg = sendgrid.SendGridAPIClient(apikey=os.environ.get('SENDGRID_API_KEY'))
 #insert code here
