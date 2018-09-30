import React from 'react'
import Head from './Head.jsx'
import { Tab, Tabs } from 'react-bootstrap'
import {Table} from 'react-bootstrap'
import TextField from './TextField.jsx'
import axios from 'axios'
import * as config from '../config'

class UpdateProfile extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {}
        },
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    _onSubmit(e) {
        e.preventDefault();
        let s = this.state;
        axios.post(config.API_PROFILE_UPDATE, {
             first_name: s.user.firstname,
             last_name: s.user.lastname,
             age: s.user.age,
             about: s.user.about,
             address: s.user.address,
             city: s.user.city,
             phone: s.user.phone,
             email: s.user.email
        }).then()
          .catch();
    }

    _onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }

    render() {
        console.log(this.props.profile);
        return(
           <div className="row">
               <form method="post" action="#" className="col-md-7 offset-md-4"
                     onSubmit={this._onSubmit}
                     onChange={this._onChange}>
               <div className="col-md-4">
                   <TextField type="text"
                         placeholder="First name"
                         name="first_name"
                         value={this.props.profile.firstname}
                   />
               </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="Last name"
                                  name="last_name"
                                  value={this.props.profile.lastname}
                       />
                   </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="Age"
                                  name="age"
                                  value={this.props.profile.age}
                       />
                   </div>
                   <div className="col-md-4">
                       <TextField type="email"
                                  placeholder="Email"
                                  name="email"
                                  value={this.state.user.email}
                       />
                   </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="City"
                                  name="city"
                                  value={this.state.user.city}
                       />
                   </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="Address"
                                  name="address"
                                  value={this.state.user.address}
                       />
                   </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="Phone"
                                  name="phone"
                                  value={this.state.user.phone}
                       />
                   </div>
                   <div className="col-md-1 offset-md-1">
                       <button type="submit" className="btn btn-outline-success">Update</button>
                   </div>
               </form>
           </div>
        );
    }
}

class ChangePassword extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            token: localStorage.getItem('access_token'),
            password: '',
            repeat_password: ''
        },
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    _onSubmit(e) {
        e.preventDefault();
        axios.post(config.API_USER_PASSWORD_UPDATE, {
            password: this.state.password,
            repeat_password: this.state.repeat_password
        }).then().catch();
    }

    _onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }

    render() {
        return(
            <div className="row">
                <form method="post" action="#" className="col-md-7 offset-md-4"
                      onSubmit={this._onSubmit}
                      onChange={this._onChange}>
                    <div className="col-md-4">
                         <TextField type="text"
                                    placeholder="New password"
                                    name="password"
                                    value={this.state.password}
                         />
                    </div>
                    <div className="col-md-4">
                        <TextField type="text"
                                   placeholder="Repeat new password"
                                   name="repeat_password"
                                   value={this.state.repeat_password}
                        />
                    </div>
                    <div className="col-md-1 offset-md-1">
                        <button type="submit" className="btn btn-outline-success">Update</button>
                    </div>
                </form>
            </div>
        );
    }
}

class Articles extends React.Component {
    constructor(props) {
        super(props);
    }

    _removeArticle() {

    }

    render() {
        let articles = this.props.articles,
            items = [];
        for (let i=0; i < articles.length; i++) {
            items.push(<tr>
                <td>{articles[i]['blog_title']}</td>
                <td>{articles[i]['created_date']}</td>
            </tr>);
        }
        return(
            <div>
                <Table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date created</th>
                        </tr>
                    </thead>
                    <tbody>
                        {items}
                    </tbody>
                </Table>
            </div>
        );
    }
}

class Orders extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let orders = this.props.orders,
            items = [];
        for (let i=0; i < orders.length; i++) {
            items.push(<tr>
                <td>{articles[i]['id']}</td>
                <td>{articles[i]['quantity']}</td>
                <td>{articles[i]['date']}</td>
                <td>{articles[i]['total']}</td>
                <td>{articles[i]['status']}</td>
            </tr>);
        }
        return(
            <div>
                <Table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        {items}
                    </tbody>
                </Table>
            </div>
        );
    }
}

export default class Profile extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
           profile: {},
           orders: [],
           articles: [],
        },
        this._deleteProfile = this._deleteProfile.bind(this);
    }

    componentDidMount() {
       axios.post(config.API_PROFILE, {
           token: localStorage.getItem('access_token')
       }).then(data => {
           this.setState({ profile: data.data.response[0] });
       }).catch();

       axios.post(config.API_USER_BLOGS, {
           token: localStorage.getItem('access_token')
       }).then(data => {
           this.setState({ articles: data.data.response.blogs });
       }).catch();

       axios.post(config.API_USER_ORDERS, {
           token: localStorage.getItem('access_token')
       }).then(data => {
           this.setState({ orders: data.data.response });
       }).catch();
    }

    _deleteProfile() {
        axios.get(config.API_PROFILE_DELETE)
            .then().catch();
    }

    render(){
        return (
            <div>
                <Head/>
                <div className="col-md-10 offset-md-1">
                    <Tabs defaultActiveKey={1} animation={false} id="noanim-tab-example">
                        <Tab eventKey={1} title="Profile">
                            <UpdateProfile profile={this.state.profile}/>
                        </Tab>
                        <Tab eventKey={2} title="Change password">
                            <ChangePassword/>
                        </Tab>
                        <Tab eventKey={3} title="Articles">
                            <Articles articles={this.state.articles}/>
                        </Tab>
                        <Tab eventKey={4} title="Orders">
                            <Orders orders={this.state.orders}/>
                        </Tab>
                        <Tab eventKey={5} title="Delete">
                             <button className="btn btn-outline-danger" onClick={this._deleteProfile}>Delete</button>
                        </Tab>
                    </Tabs>
                </div>
            </div>
        )
    }
}