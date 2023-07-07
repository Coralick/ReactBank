import React from 'react'

class Home extends React.Component {
    constructor(props) {
    super(props)
    this.state = {email: '', password: ''}
    this.handleChange = this.handleChange.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
}

handleChange(event, name) {

    this.setState({option: event.target.value})
}

handleSubmit(event) {
    alert('Ваш email: ' + this.state.email)
    event.preventDefault()
}

render() {
    return (
    <form onSubmit={this.handleSubmit}>
        <label>
        Выберите ваш любимый вкус:
        <h1>Вход</h1>
                <input type="email" placeholder="Email" onChange={this.handleChange('email')}/>
                <input type="password" placeholder="Password" onChange={this.handleChange('password')}/>
                <input type="submit" value="Вход"/>
                <a href="/regist">Вы не зарегестрированны?</a>
        </label>
    </form>
    )
}
}
export default Home