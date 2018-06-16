import React from 'react'
import axios from 'axios'
import NotificationSystem from 'react-notification-system'
import Select from 'react-select'
import 'react-select/dist/react-select.css';
import Pagination from './Pagination.jsx'
import FormFilter from './forms/FormFilter.jsx'
import * as config from '../config'
import {Link} from 'react-router-dom'

class BookItem extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            data: this.props.data,
            _notificationSystem: null
        };
        this._addToCart = this._addToCart.bind(this);
        this._addNotification = this._addNotification.bind(this);
    }

    _addNotification(msg, level)
    {
        this.state._notificationSystem.addNotification({
            message: msg,
            level: level,
            position:  'tl'
        });
    }

    componentDidMount()
    {
        this.state._notificationSystem = this.refs.notificationSystem;
    }

    _addToCart()
    {
        window.sessionStorage.setItem(this.state.data.id, JSON.stringify(this.state.data));
        this._addNotification('Successfully added in cart', 'success');
    }

    render()
    {
        return(
            <div className="row book-item">
                <NotificationSystem ref="notificationSystem" />
                <div className="col-md-4">
                    <img src={require(`../assets/img/${this.props.data.image}`)} width={100} height={100} />
                </div>
                <p>{this.props.data.title}</p>
                <strong className="price">{this.props.data.price}$</strong>
                <div className="row display-flex-end">
                    <Link className="btn btn-outline-primary" style={{marginRight: '10px'}} to={"/book/detail/" + this.props.data.id}>Detail</Link>
                    <button className="btn btn-outline-info" onClick={this._addToCart}>Add To Cart</button>
                </div>
            </div>
        );
    }
}

export default class BooksList extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            data: [],
            pageOfItems: [],
            title: ''
        };
        this.onChangePage = this.onChangePage.bind(this);
        this._onChange = this._onChange.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
    }

    componentDidMount()
    {
        axios.get(config.API_BOOKS)
            .then((data) => {
                this.setState({ data: data.data.response });
            }).catch((err) => {
                console.log(err);
            });
    }

    _onChange(e)
    {
        console.log(e.target.value);
        this.setState({ title: e.target.value });
    }

    _onSubmit(e)
    {
        e.preventDefault();
        axios.post(config.API_BOOK_SEARCH, {title: this.state.title})
             .then((data) => {
                 this.setState({ data: data.data.response });
             }).catch((err) => {
                 console.log(err);
             });
    }

    onChangePage(pageOfItems) {
        // update state with new page of items
        this.setState({ pageOfItems: pageOfItems });
    }

    render()
    {
        let items = [];
        this.state.pageOfItems.map((item) => {
                items.push(
                    <div className="col-md-5">
                        <BookItem data={item} />
                    </div>
                );
        });
        return(
            <div className="row clearfix">
                <FormFilter onChange={this._onChange}
                        onSubmit={this._onSubmit}/>
                {items}
                <div className="row margin-top-30">
                    <Pagination items={this.state.data} onChangePage={this.onChangePage}/>
                </div>
            </div>
        );
    }
}