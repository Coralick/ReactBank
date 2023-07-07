import axios from 'axios';
import React, { useState } from 'react';
import { Link } from 'react-router-dom';
function SignUp() {

    let data = {}

    const handleChange = e =>{
        let name = e.target.name
        data[name] = e.target.value
        console.log(data)
    }
    const [message, setMessage] = useState(null)

        const  http = axios.create({
            baseURL: 'http://originproject.test/',
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
                    !data.data.message? 
                        window.location.href = '/'
                        :
                        setMessage(data.data.message)
                        console.log('ответ: ', data)
                })
            })
            .then(data => { 
                
            })
            .catch((er) => {
                console.log(er)
            }) 
    }
    return(
        <div className="block">
            <form className="formStyle" onSubmit={Enter}>
                <h1>Регистрация</h1>
                <input required type="text" placeholder="name" name="name" onChange={handleChange}/>
                <input required type="text" placeholder="lastname" name="lastname" onChange={handleChange}/>
                <input required type="text" placeholder="Phone number" name="phoneNumber" onChange={handleChange}/>
                <input required type="email" placeholder="Email" name="email" onChange={handleChange}/>
                <input required type="password" placeholder="Password" name="password" onChange={handleChange}/>
                            {/* <span className="form__eye" onClick={() => setEye(prev => !prev)}>
                                {
                                    !eye ? <AiFillEye/> : <AiFillEyeInvisible/>
                                }
                                
                            </span> */}
                <input type="password" placeholder="Password repeat" name="passwordRepeat" onChange={handleChange}/>
                {message && <p className='bg-danger info'>{message}</p>}
                <button type="submit" className="btn btn-outline-primary" >Зарегестрировать</button>
                <Link to="/">У вас уже есть аккаунт?</Link>
            </form>
        </div>
    )
}
export default SignUp;