import mysql.connector 

def storeIPs(db_pass):
  db = mysql.connector.connect(
    host="midn.cs.usna.edu",
    user="patternsoflife",
    passwd=db_pass,
    database="patternsoflife")

  cursor = db.cursor()
  cursor.execute("SELECT * FROM IpAddresses")
  res = cursor.fetchall()
  return res

def ipSwitch(arg):
  switcher = {
    "7thwing":0,
    "barber":1,
    "macd":2
  }
  return switcher.get(arg,"Invalid Camera")
