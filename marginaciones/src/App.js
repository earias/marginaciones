import React from 'react';
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';

import Marginaciones from './pages/Marginaciones';
import AddMarginaciones from './pages/AddMarginacion';
import EditMarginaciones from './pages/EditMarginacion';
import Home from './home';
import Login from './Login';
import Signup from './Singup';

function App() {
  return (
    <div className="App">

        <Router>
          <Switch>
            <Route exact path="/" component={Marginaciones} />
            <Route  path="/AddMarginacion" component={AddMarginaciones} />
            <Route  path="/edit-marginacion/:id" component={EditMarginaciones} />
            <Route exact path="/Home" component={Home} />
            <Route exact path="/login" component={Login} />
            <Route exact path="/signup" component={Signup} />
          </Switch>
        </Router>
        
    </div>
  );
}

export default App;
