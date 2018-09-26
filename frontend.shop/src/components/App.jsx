import React from 'react'
import {render} from 'react-dom'
import { HashRouter, Route, Switch} from 'react-router-dom'
import Head from './Head.jsx'
import ShopCart from './ShopCart.jsx'
import MainPage from './MainPage.jsx'
import DetailBook from './DetailBook.jsx'
import OrderForm from './FormOrder.jsx'
import Login from './forms/Login.jsx'
import Register from './forms/Register.jsx'
import Profile from './Profile.jsx'


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

render(<HashRouter>
            <Switch>
                <Route exact path="/" component={App}/>
                <Route path="/shopcart" component={ShopCart}/>
                <Route path="/checkout" component={OrderForm}/>
                <Route path="/book/detail/:id" component={DetailBook}/>
                <Route path="/login" component={Login}/>
                <Route path="/register" component={Register}/>
                <Route path="/profile" component={Profile}/>
            </Switch>
    </HashRouter>
    , document.getElementById('app'));