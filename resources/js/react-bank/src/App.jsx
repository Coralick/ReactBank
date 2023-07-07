import React from 'react';
import { BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import SignIn from './Components/pages/SignIn';
import SignUp from './Components/pages/SignUp';
import TransferMoney from './Components/pages/TransferMoney';
import CloseLoan from './Components/pages/CloseLoan';
import AddLoan from './Components/pages/AddLoan';
import Main from './Components/pages/Main';

function App() {

  return (
    <Router>
      <Routes>
          <Route path="/" Component={SignIn}/>
          <Route path="/sign-up" Component={SignUp} />
          <Route path="/main" Component={Main} />
          <Route path="/transfer-money" Component={TransferMoney} />
          <Route path="/close-loan" Component={CloseLoan} />
          <Route path="/add-loan" Component={AddLoan} />
          <Route path="/test" Component={SignIn} />
      </Routes>
    </Router>

  );
}

export default App;
