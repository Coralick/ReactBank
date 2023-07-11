import axios from 'axios';
import React, { useEffect, useState } from 'react';

function CloseLoan() {

    const [message, setMessage] = useState(null)

    const [account, setAccount] = useState(String)
    const [loans, setLoans] = useState([])

    useEffect(()=>{
            axios.post('/getUserInfo')
            .then((res) => {
                if(res.data.error){
                    window.location.href = '/'
                }
                console.log('response = ', res);
                setAccount(parseFloat(res.data.cash))
                res.data.loans && setLoans(res.data.loans)
            })
            .catch((er) => {
                console.log(er)
            }) 
    }, [])
    

    let data = {}

    useEffect(()=>{
        let formData = document.querySelectorAll('.input')
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


    const createLoan = e =>{
        e.preventDefault()
        console.log(data)
        axios.put('/close-loan', data)
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
        <form onSubmit={createLoan} className="formStyle">
            <h1>Погашение</h1>
            <h2 className="bg-secondary text-light">Ваш счет: {account}</h2>
            <input required type="text" placeholder="денежная сумма" name="amountMoney" className='input' onChange={handleChange}/>
            <select name="id" className='input' onChange={handleChange}>
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