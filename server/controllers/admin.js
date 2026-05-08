'use strict';
const fs = require('fs');
const path = require('path');
const { exec } = require('child_process');

/**
 * Admin Controller for System Management
 */

const getLogs = async (req, res) => {
    try {
        const logPath = path.join(__dirname, '../../node.log');
        if (!fs.existsSync(logPath)) {
            return res.json({ status: true, logs: "No logs found yet. Start some activity!" });
        }
        
        // Read last 500 lines
        const logs = fs.readFileSync(logPath, 'utf8');
        const lines = logs.split('\n').slice(-500).join('\n');
        
        return res.json({ status: true, logs: lines });
    } catch (error) {
        return res.json({ status: false, message: error.message });
    }
};

const restartGateway = async (req, res) => {
    console.log('[Admin] Restart requested via dashboard');
    res.json({ status: true, message: "Restarting... The dashboard will be offline for a few seconds." });
    
    // Give time for response to be sent
    setTimeout(() => {
        console.log('[Admin] Process exiting for restart...');
        process.exit(0); 
    }, 1000);
};

const getSystemStatus = async (req, res) => {
    const uptime = process.uptime();
    const memory = process.memoryUsage();
    
    return res.json({
        status: true,
        uptime: Math.floor(uptime),
        memory: {
            rss: Math.round(memory.rss / 1024 / 1024) + ' MB',
            heapTotal: Math.round(memory.heapTotal / 1024 / 1024) + ' MB',
            heapUsed: Math.round(memory.heapUsed / 1024 / 1024) + ' MB'
        },
        nodeVersion: process.version,
        platform: process.platform
    });
};

module.exports = {
    getLogs,
    restartGateway,
    getSystemStatus
};
