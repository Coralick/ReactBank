import axios from 'axios';
import React, { useEffect, useState } from 'react';

function AddLoan() {

    const [message, setMessage] = useState(null)

    let data = {}

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        console.log(data)
    }

    const createLoan = e =>{
        e.preventDefault()
        console.log(data)
        axios.post('/add-loan', data)
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
    return(
        <div className="block"> 
            <form onSubmit={createLoan} className="formStyle">
                    <h1>Взять займ</h1>

                 {/* main input */}
                <input required type="number" placeholder="сумма(от 1000 до 150 000)" onChange={handleChange} name="sum"/>

                {/* correction text */}
                {message && <h4 class="text-danger">{message}</h4>}
                
                {/* interface buttons  */}
                <div>
                    <button type="button" className="btn btn-outline-danger" value='main' onClick={redirectTo}>Назад</button>
                    <button type="submit" className="btn btn-outline-primary">Создать</button>
                </div>
            </form>
        </div>
    )
}

export default AddLoan;