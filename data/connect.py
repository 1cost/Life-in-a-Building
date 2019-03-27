import mysql.connector 

# Store and return camera ips from database
def storeData(db_pass,loc, obj, count, datetime):

  # Access the database
  db = mysql.connector.connect(
    host="midn.cs.usna.edu",
    user="patternsoflife",
    passwd=db_pass,
    database="patternsoflife")

  # Return all ip addresses in the database
  cursor = db.cursor()
  args = (loc,obj,count,datetime)
  print("Storing " + loc + " " + obj + " " + str(count) + " " + datetime)
  cursor.execute("INSERT INTO CameraData (location,object,count,date) VALUES (%s,%s,%s,%s)", args)
  db.commit()

def reconstructTime(t):
    x = t.split("_")

    conv = {
      "Jan" : "01",
      "Feb" : "02",
      "Mar" : "03",
      "Apr" : "04",
      "May" : "05",
      "Jun" : "06",
      "Jul" : "07",
      "Aug" : "08",
      "Sep" : "09",
      "Oct" : "10",
      "Nov" : "11",
      "Dec" : "12"
      }

    return "2019-" + conv[x[1]] + "-"+x[0]+" " + x[3] +":"+ x[4]+":"+x[5]
    
