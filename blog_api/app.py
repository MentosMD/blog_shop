from flask import Flask
from blog.views import main
from blog_category.views import category
from flaskext.mysql import MySQL
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config.from_pyfile('config.py')
mysql = MySQL()

db = SQLAlchemy(app)

app.register_blueprint(main, url_prefix='/blog')
app.register_blueprint(category, url_prefix='/blog/category')

if __name__ == '__main__':
    app.run()