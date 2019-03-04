import mysql.connector 

# Store and return camera ips from database
def storeIPs(db_pass):

  # Access the database
  db = mysql.connector.connect(
    host="midn.cs.usna.edu",
    user="patternsoflife",
    passwd=db_pass,
    database="patternsoflife")

  # Return all ip addresses in the database
  cursor = db.cursor()
  cursor.execute("SELECT * FROM IpAddresses")
  res = cursor.fetchall()
  return res

# Select an ip based on the keyword
def ipSwitch(arg):
  switcher = {
    "7thwing":0,
    "barber":1,
    "macd":2
  }
  return switcher.get(arg,"Invalid Camera")
