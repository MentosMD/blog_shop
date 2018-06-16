from flask import Flask
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
db = SQLAlchemy(app)

class Blog(db.Model):
    id = db.Column(db.Integer, primaty_key=True)
    title = db.Column(db.String(100), unique=True, nullable=False)
    body = db.Column(db.String(1000), unique=True, nullable=False)

class Blog_Tags(db.Model):
    id = db.Column(db.Integer, primaty_key=True)

class Blog_Categories(db.Model):
    id = db.Column(db.Integer, primaty_key=True)

