import axios from 'axios';
import React, { useEffect, useState } from 'react';
function Main(){
    const [account, setAccount] = useState(String)
    const [loans, setLoans] = useState([])
    const [user, setUser] = useState({})
    

    useEffect(()=>{
                axios.post('/getUserInfo')
                .then((res) => {
                    if(res.data.error){
                        window.location.href = '/'
                    }

                    console.log('response = ', res);
                    setUser(res.data.user)
                    setAccount(parseFloat(res.data.cash))
                    res.data.loans && setLoans(res.data.loans)

                })
                .catch((er) => {
                    console.log(er)
                }) 
    }, [])

    const redirectTo = e =>{
        window.location.href = '/' + e.target.value
    }
    const logOut = e =>{
        axios.post('/log-out')
        .then(() =>{
            window.location.href = '/'
        })
    }
    return(
        <div>
            <div className='header'>
                <button className="btn btn-warning" type="button"  onClick={logOut}>	&#8656; Выход</button>
            </div>
            <div className="interface">
            
                {/* accounts interface */}
                <div className="section">
                <h1>Здравствуйте, {user.name} {user.lastname}</h1>
                    <div className="bg-secondary panel"> 
                        <div className="info">
                            <h1>Счет:</h1>
                            <h1>{String(account)} руб</h1>
                        </div>
                        <button className="btn btn-warning " type="button" value='transfer-money' onClick={redirectTo}>Перевод средств</button>
                    </div>
                </div>

                {/* loans interface */}
                <div className="section">
                    <div className="title">
                        <h2>Займы</h2>  
                        {(loans.length != 0) && <button className="btn btn-warning" value='close-loan' onClick={redirectTo}>Погасить</button>}
                        {(loans.length < 3) && <button type="button" className="btn btn-primary" value='add-loan' onClick={redirectTo}>+</button> }
                    </div>
                    <hr/>
                    <div className="background-list">

                    {loans.map(({id, sum})=> {
                            return <div key={id} className="bg-secondary panel">
                                <h2>{id + ')'} {sum} руб</h2>
                                </div>
                        })
                    }
                        {loans.length === 0 && <h2>У вас нет займов</h2>}
                    </div>  
                </div>
            </div>
        </div>
        
    )
}
export default Main;