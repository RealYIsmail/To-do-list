import React from 'react';
import { CssBaseline } from '@material-ui/core';
import ReactDOM from 'react-dom';
import TodoTable from './Js/components/TodoTable';
import TodoContextProvider from './Js/contexts/TodoContext';

class App extends React.Component {
    render() {
        return (
            <TodoContextProvider>
                <CssBaseline>
                    <TodoTable/>
                </CssBaseline>
            </TodoContextProvider>
        );
    }
}
ReactDOM.render(<App/>, document.getElementById('root'));