# $ pip install httpclient

# MAKE SURE THE PI FILE RETURNS A STRING WHEN A MOTION IS DETECTED

from httpclient import HttpClient
import piScript

http_client = HttpClient()
prevMotion = "";
while(True):
    while(True):

        # Need to see what pi outputs first before finishing
        # Assumed getMotion will properly wait until input is received so no waiting required in this script
        motion = piScript.getMotion()
        if(motion != prevMotion):
            prevMotion = motion
            break;

    page = http_client.post("http://www.some-site.org/login",
                        {"motion": motion})
