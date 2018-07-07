from flask import Flask
from routers import main
from flaskext.mysql import MySQL

app = Flask(__name__)
mysql = MySQL()
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = '563562'
app.config['MYSQL_DATABASE_DB'] = 'BookShop'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)

app.register_blueprint(main, url_prefix='/blog')
app.register_blueprint(main, url_prefix='/blog/category')

if __name__ == '__main__':
    app.run()