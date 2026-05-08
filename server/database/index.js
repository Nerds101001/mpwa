const mysql2 = require('mysql2');
require('dotenv').config()
// Create the connection pool. The pool-specific settings are the defaults
const db = mysql2.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USERNAME,
    database: process.env.DB_DATABASE,
    password: process.env.DB_PASSWORD,
   // port: process.env.DB_PORT,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});



const setStatus = (device, status) => {
    try {
        db.query(`UPDATE devices SET status = '${status}' WHERE body = ${device} `)
        return true;

    } catch (error) {
        return false
    }
}

function dbQuery(query) {
    return new Promise(resolve => {
        db.query(query, (err, res) => {
            if (err) {
                console.error('Database Error:', err);
                return resolve([]);
            }
            resolve(res);
        })
    })
}



module.exports = { setStatus, dbQuery,db }

// EXPORT
