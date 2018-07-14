from flask import Blueprint
from flask import Flask
from flask import jsonify

app = Flask(__main__)
main = Blueprint('main', __name__)

@main.route('/')
def index():
    return "Main"

@main.route('/example')
def example():
    return "example"