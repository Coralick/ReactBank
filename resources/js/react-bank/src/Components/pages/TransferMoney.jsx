import React, { useEffect, useState } from 'react';
import axios from 'axios';

function TransferMoney() {
    const [account,setAccount] = useState(String)
    useEffect(()=>{
        axios.post('/getUserInfo')
        .then(res =>{
            console.log('response= ',res )
            setAccount(res.data.cash)
        })
    })

    let data = {}

    const [message, setMessage] = useState(null)

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        console.log(data)
    }

    const Enter = e =>{
        e.preventDefault()
        axios.put('/transfer-money', data)
        .then(res =>{
            console.log(res)
            !res.data.message? 
            window.location.href = '/main'
            :
            setMessage(res.data.message)
        })
    }

    const redirectTo = e =>{
        window.location.href = '/' + e.target.value
    }

    return (
        <div className="block" onSubmit={Enter}>
            <form  className="formStyle">
                <h1>Перевод</h1>
                <h1 className='bg-success info'>Счет: {account} руб</h1>

                <input required type="text" placeholder="номер телефона" name="transferNumber" onSubmit={handleChange} onChange={handleChange}/>
                <input required type="text" placeholder="денежная сумма" name="amountMoney" onChange={handleChange}/>
                {message && <p className='bg-danger info'>{message}</p>}
                

                <div>
                    <button type="button" value='main' className="btn btn-outline-danger" onClick={redirectTo}>Назад</button>
                    <button type="submit" className="btn btn-outline-primary">Перевести</button>
                </div>
            </form>
        </div>
    );
}

export default TransferMoney;