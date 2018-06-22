import React from 'react'
import Head from './Head.jsx'

export default class MainPage extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = {}
    }

    render()
    {
        return(
            <div className="row">
                <Head/>
            </div>
        );
    }
}