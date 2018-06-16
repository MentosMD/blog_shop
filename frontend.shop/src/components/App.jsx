import React from 'react'
import {render} from 'react-dom'
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom'
import createBrowserHistory from 'history/createBrowserHistory'
import Head from './Head.jsx'
import ShopCart from './ShopCart.jsx'
import MainPage from './MainPage.jsx'
import DetailBook from './DetailBook.jsx'
import OrderForm from './FormOrder.jsx'

import Main from './Admin/Main.jsx'

import 'bootstrap/dist/css/bootstrap.css';
import '../assets/app.styl'

class App extends React.Component {
    constructor(props){
        super(props)
    }

    render(){
        return(
            <div className="row">
               <Head/>
               <div className="container">
                   <MainPage/>
               </div>
            </div>
        );
    }
}
const history = createBrowserHistory();
render(<Router>
            <Switch>
                <Route exact path="/" component={App}/>
                <Route path="/shopcart" component={ShopCart}/>
                <Route path="/checkout" component={OrderForm}/>
                <Route path="/book/detail/:id" component={DetailBook}/>
                <Route path="/admin/main" component={Main}/>
                <Route path="/admin/login" component={}/>
                <Route path="/admin/books" component={}/>
                <Route path="/admin/orders" component={}/>
            </Switch>
    </Router>
    , document.getElementById('app'));