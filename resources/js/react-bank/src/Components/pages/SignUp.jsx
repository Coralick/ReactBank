import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
function SignUp() {

    let data = {}
    const phonePattern = /^((8|\+7)[- ]?)?((\d{3})?[- ]?)?[\d- ]{7,10}$/
    const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

    const [phone, setPhone] = useState(true)
    const [email, setEmail] = useState(true)
    const [message, setMessage] = useState(null)

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        sessionStorage.setItem(name, e.target.value)
    }
    const emailIsValid = e =>{
        if(!emailPattern.test(e.target.value) && e.target.value != ''){
            setEmail(false)
        }
        else{
            setEmail(true)
            data[e.target.name] = e.target.value
            sessionStorage.setItem(e.target.name, e.target.value)
        }
    }

    const phoneIsValid = e =>{
        if(!phonePattern.test(e.target.value) && e.target.value != ''){
            setPhone(false)
        }
        else{
            setPhone(true)
            data[e.target.name] = e.target.value
            sessionStorage.setItem(e.target.name, e.target.value)
        }
    }

    useEffect(()=>{
        let formData = document.querySelectorAll('input')
        formData.forEach(input => {
            data[input.name] = sessionStorage.getItem(input.name)
        });
        console.log(data)
    }, [data])

    const  http = axios.create({
        baseURL: 'http://origin-project.test/',
        withCredentials: true,
        headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'content-type': 'application/json',
        },
        
    })

    const Enter = e => {
        e.preventDefault()
        http.get('/sanctum/csrf-cookie')
            .then(() => {
                http.post('/sign-up', data)
                .then(data => {
                    if(!data.data.message){
                        sessionStorage.clear()
                        window.location.href = '/' 
                    }

                    else{
                        setMessage(data.data.message)
                    }
                        console.log('ответ: ', data)
                })
            })

            .catch((er) => {
                console.log(er)
            }) 
    }
    return(
        <div className="block">
            <form className="formStyle" onSubmit={Enter}>
                <h1>Регистрация</h1>
                <input required type="text" placeholder="name" name="name"  onChange={handleChange}/>
                <input required type="text" placeholder="lastname" name="lastname"  onChange={handleChange}/>
                <input required type="text" className={!phone && 'text-danger'} placeholder="Phone number" name="phoneNumber" onChange={phoneIsValid}/>
                {!phone && <p className='text-danger'>Не правильный номер телефона</p>}
                <input required type="email" className={!email && 'text-danger'} placeholder="Email" name="email"  onChange={emailIsValid}/>
                {!email && <p className='text-danger'>Неверный email</p>}
                <input required type="password" placeholder="Password" name="password"  onChange={handleChange}/>
                <input type="password" placeholder="Password repeat" name="passwordRepeat"  onChange={handleChange}/>
                {message && <p className='bg-danger info'>{message}</p>}
                <button disabled={!phone && !email} type="submit" className="btn btn-outline-secondary" >Зарегестрировать</button>
                <Link to="/" className='text-success'>У вас уже есть аккаунт?</Link>
            </form>
        </div>
    )
}
export default SignUp;