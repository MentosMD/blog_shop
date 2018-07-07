from flask import Flask
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
db = SQLAlchemy(app)

class Blog_Categories(db.Model):
    id = db.Column(db.Integer, primaty_key=True)