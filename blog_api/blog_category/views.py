from flask import Blueprint
from flask import jsonify

main = Blueprint('main', __name__)

@main.route('/list')
def main():
    return 'Category'