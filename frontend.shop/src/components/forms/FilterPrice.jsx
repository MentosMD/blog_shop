import React from 'react'
import TextField from '../TextField.jsx'
import axios from 'axios'

export default class FilterPrice extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            priceFrom: 0,
            priceTo: 0
        };
        this._onChange = this._onChange.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
    }

    _onChange(e)
    {

    }

    _onSubmit(e)
    {
        e.preventDefault();
        axios.post()
            .then((data) => {
                console.log(data);
            }).catch((err) => {
                console.log(err);
            })
    }

    render(){
        return(
            <div className="row">
                 <div className="container">
                     <form method="post" action="#" onSubmit={this._onSubmit}>
                         <div className="col-md-1">
                             <span>From</span>
                             <TextField type="text"
                                        placeholder="0"
                                        value={this.state.priceFrom}
                                        name="price_from"
                                        onChange={this._onChange}
                             />
                         </div>
                         <div className="col-md-1">
                             <span>To</span>
                             <TextField type="text"
                                        placeholder="0"
                                        value={this.state.priceTo}
                                        name="price_to"
                                        onChange={this._onChange}
                             />
                         </div>
                     </form>
                 </div>
            </div>
        );
    }
}