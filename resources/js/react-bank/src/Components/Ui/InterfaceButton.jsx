import React from 'react';

function InterfaceButton(clickEvent) {
    return (
        <div>
            <button type="button" className="btn btn-outline-danger" value='main' onClick={clickEvent}>Назад</button>
            <button type="submit" className="btn btn-outline-primary">Перевести</button>
        </div>
    );
}

export default InterfaceButton;