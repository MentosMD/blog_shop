const URL_BASE = 'http://127.0.0.1:8000';
const URL_BASE_BLOG = 'http://127.0.0.1:5000';

export const API_BOOKS = URL_BASE + '/api/books';
export const API_BOOK_DETAIL = URL_BASE + '/api/book/detail/';
export const API_BOOK_SEARCH = URL_BASE + '/api/book/search';
export const API_BOOK_BY_PRICE = URL_BASE + '/api/book/search/by/price';
export const API_BOOK_PRICE_MIN_MAX = URL_BASE + '/api/book/price/min/max';
export const API_BOOK_COMMENT_ADD = URL_BASE + '/api/book/comment/add';

export const API_ORDER_ADD = URL_BASE + '/api/order/add';

export const API_USER_LOGIN = 'http://127.0.0.1:5000/api/v1/user/login';
export const API_USER_REGISTER = 'http://127.0.0.1:5000/api/v1/user/register';
export const API_USER_PASSWORD_UPDATE = 'http://127.0.0.1:5000/api/v1/user/password/update';

export const API_USER_BLOGS = URL_BASE_BLOG + '/api/v1/user/blogs';
export const API_USER_ORDERS = URL_BASE_BLOG + '/api/v1/user/orders';
export const API_PROFILE = URL_BASE_BLOG + '/api/v1/profile';
export const API_PROFILE_UPDATE = URL_BASE_BLOG + '/api/v1/profile/update';
export const API_PROFILE_DELETE = URL_BASE_BLOG + '/api/v1/profile/delete';