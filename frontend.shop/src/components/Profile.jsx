import React from 'react'
import Head from './Head.jsx'
import { Tab, Tabs } from 'react-bootstrap'
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
        axios.post().then().catch();
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
                         placeholder="First name"
                         name="first_name"
                         value={this.state.user.first_name}
                   />
               </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="Last name"
                                  name="last_name"
                                  value={this.state.user.last_name}
                       />
                   </div>
                   <div className="col-md-4">
                       <TextField type="text"
                                  placeholder="Age"
                                  name="age"
                                  value={this.state.user.age}
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

        },
        this._onSubmit = this._onSubmit.bind(this);
        this._onChange = this._onChange.bind(this);
    }

    _onSubmit(e) {
        e.preventDefault();
        axios.post().then().catch();
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

    render() {
        return(
            <div></div>
        );
    }
}

class Orders extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div></div>
        );
    }
}

export default class Profile extends React.Component {
    constructor(props) {
        super(props)
    }

    componentDidMount() {
       // axios.get().then().catch();
    }

    render(){
        return (
            <div>
                <Head/>
                <div className="col-md-10 offset-md-1">
                    <Tabs defaultActiveKey={1} animation={false} id="noanim-tab-example">
                        <Tab eventKey={1} title="Profile">
                            <UpdateProfile/>
                        </Tab>
                        <Tab eventKey={2} title="Change password">
                            <ChangePassword/>
                        </Tab>
                        <Tab eventKey={3} title="Articles">
                            <Articles/>
                        </Tab>
                        <Tab eventKey={4} title="Orders">
                            <Orders/>
                        </Tab>
                    </Tabs>
                </div>
            </div>
        )
    }
}