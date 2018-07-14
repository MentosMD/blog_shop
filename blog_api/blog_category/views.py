from flask import Blueprint
from flask import jsonify

category = Blueprint('category', __name__)

@category.route('/')
def index():
    return 'Category'