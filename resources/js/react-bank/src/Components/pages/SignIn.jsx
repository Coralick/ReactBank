import axios from 'axios'
import React, { useEffect, useMemo, useState } from 'react'
import { Link } from 'react-router-dom'
function SignIn() {
    const [message, setMessage] = useState(null)
    let data = {}

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        console.log(data)
    }
        const  http = axios.create({
            baseURL: 'http://originproject.test/',
            withCredentials: true,
            headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'content-type': 'application/json',
            },
            
        })


    const Enter = (event) => {
        event.preventDefault()
        http.get('/sanctum/csrf-cookie')
            .then(() => {
                http.post('/login', data)
                .then(data => {
                    !data.data.message? 
                    window.location.href = '/main'
                    :
                    setMessage(data.data.message)
                })
            })
            .catch((er) => {
                console.log(er)
            }) 
    }
    

    return(
        <div className="block">
            <form onSubmit={Enter}  className="formStyle">
                
                <h1>Вход</h1>
                <input required type="email" placeholder="Email" name="email" onChange={handleChange}/>
                <input required type="password" placeholder="Password" name="password" onChange={handleChange}/>
                <button type="submit" className="btn btn-outline-primary">Вход</button>
                
                {/* correction text */}
                {message && <p className='bg-danger info'>{message}</p>}

                <Link to='/sign-up'>Вы не зарегестрированны?</Link>
            </form>
        </div>
    )
}
export default SignIn













// fetch('http://originproject.test/getCSRF')
        //     .then(data => {
        //         console.log('data', data, 1);
        //     })
        //     .catch(error => {
        //         console.log('error', error, 2);
        //     })
        // fetch("http://localhost/originProject/public//test")
        // .then(response => response.json())
        // .then(data =>{
        //     console.log('data', data, 1);
        //     setToken(data.token)
        // })
        // .catch(error => {
        //     console.log('error', error, 2);
        // })
        // const  http = axios.create({
        //     baseURL: 'http://originproject.test/',
        //     withCredentials: true,
        //     headers: {
        //     'X-Requested-With': 'XMLHttpRequest',
        // },
        // });
        // const csrf = http.get('/sanctum/csrf-cookie')
        // console.log('csrf = ', csrf);