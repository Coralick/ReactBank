import axios from 'axios';
import React, { useEffect, useState } from 'react';

function AddLoan() {
    let data = {}

    const [message, setMessage] = useState(null)
    const [money, setMoney] = useState(true)

    useEffect(()=>{
        let formData = document.querySelectorAll('input')
        formData.forEach(input => {
            data[input.name] = sessionStorage.getItem(input.name)
        });
        console.log(data)
    }, [data])

    const handleChange = e =>{
        let name = e.target.name
        if(!/^\d+$/.test(e.target.value) && e.target.value != ''){
            setMoney(false)
        }
        else{
            setMoney(true)
            data[name] = e.target.value
            sessionStorage.setItem(name, e.target.value)
        }
    }

    const createLoan = e =>{
        e.preventDefault()
        console.log(data)
        axios.post('/add-loan', data)
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

    return(
        <div className="block"> 
            <form onSubmit={createLoan} className="formStyle">
                    <h1>Взять займ</h1>

                 {/* main input */}
                <input required type="text" placeholder="сумма(от 1000 до 150 000)"  className={!money && 'text-danger'} onChange={handleChange} name="sum"/>
                {!money && <h4 className='text-danger'>Не правильно указанна сумма</h4>}
                
                {message && <h4 class="text-danger">{message}</h4>}
                {/* interface buttons  */}
                <div>
                    <button type="button" className="btn btn-outline-danger" value='main' onClick={redirectTo}>Назад</button>
                    <button type="submit" disabled={!money} className="btn btn-outline-primary">Создать</button>
                </div>
            </form>
        </div>
    )
}

export default AddLoan;