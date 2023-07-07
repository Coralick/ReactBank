import axios from 'axios';
import React, { useEffect, useState } from 'react';

function CloseLoan() {

    const [message, setMessage] = useState(null)

    const [account, setAccount] = useState(String)
    const [loans, setLoans] = useState([])

    useEffect(()=>{
                axios.post('/getUserInfo')
                .then((res) => {
                    console.log('response = ', res);
                    setAccount(parseFloat(res.data.cash))
                    res.data.loans && setLoans(res.data.loans)

                })
                .catch((er) => {
                    console.log(er)
                }) 
    }, [])
    

    let data = {}

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        console.log(data)
    }

    const createLoan = e =>{
        e.preventDefault()
        console.log(data)
        axios.put('/close-loan', data)
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
        <form onSubmit={createLoan} className="formStyle">
            <h1>Погашение</h1>
            <h2 className="bg-primary text-light">Ваш счет: {account}</h2>

            <input required type="number" placeholder="денежная сумма" name="amountMoney" step="0.01" onChange={handleChange}/>
            <select name="id" onChange={handleChange}>
            <option disabled selected value={0}>Выберите займ</option>
                {loans && loans.map(({id, sum})=>{
                    return <option name="id" value={id} key={id}>{id + ")"} {sum}</option>
                })}
            </select>
                {/* correction text */}
                {message && <h4 class="text-danger">{message}</h4>}
            <div>
                <button type="button" className="btn btn-outline-danger" value='main' onClick={redirectTo}>Назад</button>
                <button type="submit" className="btn btn-outline-primary">Перевести</button>
            </div>
        </form>
    );
}

export default CloseLoan;