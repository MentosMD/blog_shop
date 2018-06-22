import React from 'react'
import {render} from 'react-dom'
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom'
import createBrowserHistory from 'history/createBrowserHistory'
import Head from './Head.jsx'
import MainPage from './MainPage.jsx'
import AddBookForm from './forms/AddBookForm.jsx'
import EditBookForm from './forms/EditBookForm.jsx'
import OrdersList from './OrdersList.jsx'

import 'bootstrap/dist/css/bootstrap.css';
import '../assets/app.styl'

class App extends React.Component {
    constructor(props){
        super(props)
    }

    render(){
        return(
            <div className="row">
                <MainPage/>
            </div>
        );
    }
}
const history = createBrowserHistory();
render(<Router history={history}>
            <Switch>
                <Route exact path="/" component={App}/>
                <Route path="/admin/book/add" component={AddBookForm}/>
                <Route path="/admin/book/edit" component={EditBookForm}/>
                <Route path="/admin/orders" component={OrdersList}/>
            </Switch>
    </Router>
    , document.getElementById('app'));