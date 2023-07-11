import React, { useEffect, useState } from 'react';
import axios from 'axios';

function TransferMoney() {
    let data = {}

    const [account,setAccount] = useState(String)
    
    useEffect(()=>{
        axios.post('/getUserInfo')
        .then(res =>{
            if(res.data.error){
                window.location.href = '/'
            }
            console.log('response= ',res )
            setAccount(res.data.cash)
        })
    })


    const [message, setMessage] = useState(null)

    useEffect(()=>{
        let formData = document.querySelectorAll('input')
        formData.forEach(input => {
            data[input.name] = sessionStorage.getItem(input.name)
        });
        console.log(data)
    }, [data])

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        sessionStorage.setItem(name, e.target.value)
    }
    const Enter = e =>{
        e.preventDefault()
        axios.put('/transfer-money', data)
        .then(data =>{
            if(!data.data.message){
                sessionStorage.clear()
                window.location.href = '/main' 
            }

            else{
                setMessage(data.data.message)
            }
        })
    }

    const redirectTo = e =>{
        window.location.href = '/' + e.target.value
    }

    return (
        <div className="block" onSubmit={Enter}>
            <form  className="formStyle">
                <h1>Перевод</h1>
                <h1 className='bg-secondary info'>Счет: {account} руб</h1>

                <input required type="text" placeholder="номер телефона" name="transferNumber" onSubmit={handleChange} onChange={handleChange}/>
                <input required type="text" placeholder="денежная сумма" name="amountMoney" onChange={handleChange}/>
                {message && <h4 class="text-danger">{message}</h4>}
                

                <div>
                    <button type="button" value='main' className="btn btn-outline-danger" onClick={redirectTo}>Назад</button>
                    <button type="submit" className="btn btn-outline-primary">Перевести</button>
                </div>
            </form>
        </div>
    );
}

export default TransferMoney;