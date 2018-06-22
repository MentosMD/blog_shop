import React from 'react'
import {FormGroup, FormControl, ControlLabel} from 'react-bootstrap'

export default class TextField extends React.Component
{
    constructor(props)
    {
        super(props);
        this._onChange = this._onChange.bind(this);
    }

    _onChange(e)
    {
        this.props.onChange(e);
    }

    render()
    {
        return(
            <div>
                <FormGroup>
                    <ControlLabel>
                        {this.props.error ?
                            <label className="text-danger">{this.props.error}</label> : null
                        }
                    </ControlLabel>
                    <FormControl
                        type={this.props.type}
                        name={this.props.name}
                        value={this.props.value}
                        placeholder={this.props.placeholder}
                        onChange={this._onChange}
                        required={this.props.required}
                    />
                    <FormControl.Feedback />
                </FormGroup>
            </div>
        );
    }
}