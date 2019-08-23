from typing import List, Dict
from flask import Flask , jsonify,abort,make_response,request,url_for,render_template , current_app, Markup, Blueprint ,redirect
from flask_httpauth import HTTPBasicAuth
from flask_basicauth import BasicAuth
import mysql.connector
import json
import datetime
import urllib.request, json




app = Flask(__name__)

app.config['BASIC_AUTH_FORCE'] = True

app.config['BASIC_AUTH_USERNAME'] = 'Michiel'
app.config['BASIC_AUTH_PASSWORD'] = 'Python'

basic_auth = BasicAuth(app)


'''
@basic_auth.error_handler
def unauthorized():
    return make_response(jsonify({'error': 'Unauthorized access'}), 401)
'''

@app.route('/create_table/<string:name>', methods=['POST'])
@basic_auth.required
def create_table(name):
    
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'Stock'
    }
    connection = mysql.connector.connect(**config)
    mycursor = connection.cursor()

    stmt = "SHOW TABLES LIKE '{0}'".format(name)
    mycursor.execute(stmt)
    result = mycursor.fetchone()
    if result:
        tekst = "Table {0} already exists".format(name)
    else:
        mycursor.execute("CREATE TABLE IF NOT EXISTS {0} (Price  decimal(10,2) , Timestamp datetime )".format(name))
        mycursor.execute("ALTER TABLE {0} ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY".format(name))
        tekst = "Table {0} is created".format(name)

    if (connection.is_connected()):
        mycursor.close()
        connection.close()
        print("MySQL connection is closed")
    

    return tekst


@app.route('/init')
@basic_auth.required
def init():
    
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'Stock'
    }
    connection = mysql.connector.connect(**config)
    mycursor = connection.cursor()

    stmt = "SHOW TABLES LIKE 'stock_table'"
    mycursor.execute(stmt)
    result = mycursor.fetchone()
    if result:
        tekst = "Table stock_table already exists"
    else:
        mycursor.execute("CREATE TABLE IF NOT EXISTS stock_table (  Price  decimal(10,2) , Timestamp datetime )")
        mycursor.execute("ALTER TABLE stock_table ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY")
        tekst = "Table stock_table is created"

    if (connection.is_connected()):
        mycursor.close()
        connection.close()
        print("MySQL connection is closed")
    

    return tekst


def stock_price() -> List[Dict]:
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'Stock'
    }

    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    cursor.execute('SELECT * FROM MSFT')
    results = ""
    record = cursor.fetchall()
    for row in record:
        results = results + "Price: " + str(row[0]) + "$ "
        results = results + "Date: " + str(row[1])
        results = results + " ID: " + str(row[2])
        print("Price = ", row[0], )
        print("Date = ", row[1])
        print("ID  = ", row[2], "\n")

    cursor.close()
    connection.close()

    return results

def stock_price2(name) -> List[Dict]:
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'db',
        'port': '3306',
        'database': 'Stock'
    }

    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    String =  "SELECT * FROM  {0}".format(name)
    cursor.execute(String)
    results = ""
    record = cursor.fetchall()
    for row in record:
        results = results + "Price: " + str(row[0]) + "$ "
        results = results + "Date: " + str(row[1])
        results = results + " ID: " + str(row[2])
        print("Price = ", row[0], )
        print("Date = ", row[1])
        print("ID  = ", row[2], "\n")

    cursor.close()
    connection.close()

    return results


@app.route('/get_all/<string:name>', methods=['GET'])
@basic_auth.required
def get_all(name):

    config = {
            'user': 'root',
            'password': 'root',
            'host': 'db',
            'port': '3306',
            'database': 'Stock'
            }

    mydb = mysql.connector.connect(**config)
    mycursor = mydb.cursor()


    stmt = "SHOW TABLES LIKE '{0}'".format(name)
    mycursor.execute(stmt)
    result = mycursor.fetchone()
    if result:
        tekst = "Table {0} already exists".format(name)
    else:
        mycursor.execute("CREATE TABLE IF NOT EXISTS {0} (Price  decimal(10,2) , Timestamp datetime )".format(name))
        mycursor.execute("ALTER TABLE {0} ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY".format(name))
        tekst = "Table {0} is created".format(name)

    url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={0}&apikey=KXWDVMQTLDECZFOK".format(name)
    try:
        with urllib.request.urlopen(
                url) as url:
            data = json.loads(url.read().decode())
        test = data.get("Global Quote")
        if (test == {}):
            data = {}
            data['ID error'] = []
        else:
            tekst = "INSERT INTO {0} (Price, Timestamp) VALUES (%s, %s)".format(name)
            sql = tekst
            now = datetime.datetime.now()
            val = (data['Global Quote']['03. high'], now)
            mycursor.execute(sql, val)
            mydb.commit()
        print("Server Online")

    except urllib.error.HTTPError as e:
        print("Server Offline")
        data = {}
        data['HTTPError'] = []

    except urllib.error.URLError as e:
        print("Server Offline")
        data = {}
        data['URLError'] = []
    return jsonify(data)

@app.route('/price_high/<string:name>', methods=['GET'])
@basic_auth.required
def get_price(name):

    config = {
            'user': 'root',
            'password': 'root',
            'host': 'db',
            'port': '3306',
            'database': 'Stock'
            }

    mydb = mysql.connector.connect(**config)
    mycursor = mydb.cursor()

    respons = 0

    stmt = "SHOW TABLES LIKE '{0}'".format(name)
    mycursor.execute(stmt)
    result = mycursor.fetchone()
    if result:
        tekst = "Table {0} already exists".format(name)
    else:
        mycursor.execute("CREATE TABLE IF NOT EXISTS {0} (Price  decimal(10,2) , Timestamp datetime )".format(name))
        mycursor.execute("ALTER TABLE {0} ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY".format(name))
        tekst = "Table {0} is created".format(name)

    url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={0}&apikey=KXWDVMQTLDECZFOK".format(name)
    try:
        with urllib.request.urlopen(
                url) as url:
            data = json.loads(url.read().decode())
        test = data.get("Global Quote")
        if (test == {}):
            data = {}
            data['ID error'] = []
        else:
            tekst = "INSERT INTO {0} (Price, Timestamp) VALUES (%s, %s)".format(name)
            sql = tekst
            now = datetime.datetime.now()
            respons = data['Global Quote']['03. high']
            val = (data['Global Quote']['03. high'], now)
            mycursor.execute(sql, val)
            mydb.commit()
        print("Server Online")

    except urllib.error.HTTPError as e:
        print("Server Offline")
        data = {}
        data['HTTPError'] = []

    except urllib.error.URLError as e:
        print("Server Offline")
        data = {}
        data['URLError'] = []
    return jsonify(respons)



@app.route('/')
@basic_auth.required
def index() -> str:
    return json.dumps({'stock_price': stock_price()})


@app.route('/getData/<string:name>', methods=['GET'])
@basic_auth.required
def get(name) -> str:
    return json.dumps({'stock_price': stock_price2(name)})

@app.route('/help')
def hello():
    return redirect("https://documenter.getpostman.com/view/7994621/SVfMRUvj?version=latest", code=302)


if __name__ == '__main__':
    app.run(host='0.0.0.0')
