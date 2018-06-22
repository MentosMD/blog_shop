import React from 'react'
import {Link} from 'react-router'

export default class Head extends React.Component
{
    constructor(props)
    {
        super(props);
    }

    render()
    {
        return(
            <div className="container">
                <nav className="row menu">
                    <ul>
                        <li><a href="/">Main</a></li>
                        <li><a href="/admin/book/add">Add book</a></li>
                    </ul>
                </nav>
            </div>
        );
    }
}