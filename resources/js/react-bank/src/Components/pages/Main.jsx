import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { redirect } from 'react-router-dom';
function Main(){
    const [account, setAccount] = useState(String)
    const [loans, setLoans] = useState([])
    const [user, setUser] = useState({})

    useEffect(()=>{
                axios.post('/getUserInfo')
                .then((res) => {
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
    return(
        
        <div>
            <div className='header'>
                <button className="btn btn-danger " type="button" value='' onClick={redirectTo}>	&#10060; Выход</button>
            </div>
            <h1>Здравствуйте, {user.name} {user.lastname}</h1>
        <div className="interface">
        
            {/* accounts interface */}
            <div className="section">
                <div className="bg-primary panel"> 
                    <div className="info">
                        <h1>Счет:</h1>
                        <h1>{String(account)} руб</h1>
                    </div>
                    <button className="btn btn-success " type="button" value='transfer-money' onClick={redirectTo}>Перевод средств</button>
                </div>
            </div>

            {/* loans interface */}
            <div className="section">
                <div className="title">
                    <h2>Займы</h2>  
                    <button className="btn btn-success" value='close-loan' onClick={redirectTo}>Погасить</button>
                    {(loans.length < 3) && <button type="button" className="btn btn-primary" value='add-loan' onClick={redirectTo}>+</button> }
                </div>
                <hr/>
                <div className="background-list">

                {loans.map(({id, sum})=> {
                        return <div key={id} className="panel bg-primary">
                            <h2>{id + ')'} {sum} руб</h2>
                            </div>
                    })
                }

                    {!loans && <h2>У вас нет займов</h2>}
                </div>  
            </div>
        </div>
        </div>
        
    )
}
export default Main;