from flask import Blueprint
from flask import jsonify

main = Blueprint('main', __name__)

@main.route('/')
def index():
    return "Main"

@main.route('/about')
def example():
    return "About"