const { NFC } = require('nfc-pcsc');
const WebSocket = require('ws');

const nfc = new NFC();
const wss = new WebSocket.Server({ port: 8090 });

wss.on('connection', ws => {
    console.log('WebSocket connection established');
});

nfc.on('reader', reader => {
    console.log(`${reader.reader.name} device attached`);

    reader.on('card', async card => {
        console.log(`Card detected`, card);

        try {
            const response = await reader.transmit(Buffer.from([0xFF, 0xCA, 0x00, 0x00, 0x00]), 40);
            let cardUid = response.toString('hex').slice(0, 8);  // Get the first 8 digits of the UID
            console.log(`Card UID: ${cardUid}`);

            // Broadcast the card UID to all connected WebSocket clients
            wss.clients.forEach(client => {
                if (client.readyState === WebSocket.OPEN) {
                    client.send(cardUid);
                }
            });
        } catch (err) {
            console.error(`Error:`, err);
        }
    });

    reader.on('card.off', card => {
        console.log(`Card removed`, card);
    });

    reader.on('error', err => {
        console.error(`${reader.reader.name} error:`, err);
    });

    reader.on('end', () => {
        console.log(`${reader.reader.name} device removed`);
    });
});

nfc.on('error', err => {
    console.error('NFC error:', err);
});
