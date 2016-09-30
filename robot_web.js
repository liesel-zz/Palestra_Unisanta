var Cylon               = require('cylon');
var express             = require('express');        // call express
var bodyParser          = require('body-parser');
var myBB8               = {};

myBB8  = Cylon.robot({
  connections: {
    bluetooth: { adaptor: 'central', uuid: 'ca752f39f71e', module: 'cylon-ble' }
  },

  devices: {
    bb8: { driver: 'bb8', module: 'cylon-sphero-ble' }
  },

  work: function(my) {
    myBB8 = my;
    my.bb8.color(0x00FFFF);
    //
    // ROUTES FOR OUR API
    // =============================================================================
    var router = express.Router();              // get an instance of the express Router
    
    // test route to make sure everything is working (accessed at GET http://localhost:8080/api)
    router.get('/', function(req, res) {
        req.query.param = req.query.param.toLowerCase();
        var velocity = 700;
        switch (req.query.param) {
            case "color":
                my.bb8.randomColor();        
                break;

            case "frente": 
                my.bb8.roll(velocity, 0);        
                break;

            case "esquerda": 
                my.bb8.roll(velocity, 90);        
                break;

            case "direita": 
                my.bb8.roll(velocity, 270);        
                break;

            case "tras":
                my.bb8.roll(velocity, 180);        
                break;

            case "balancar":
                my.bb8.spin("left",50);
                my.bb8.spin("right",100);
                my.bb8.spin("left",20);
                my.bb8.spin("right",90);
                my.bb8.spin("left",220);
                my.bb8.spin("right",120);
                my.bb8.spin("left",50);
                my.bb8.spin("right",10);        
                break;
        
            default:
                break;
        }

        after(1500, function() {
            my.bb8.stop();
        });
        res.json({ message: 'BEEE BEEE BEEE BOOO BEEE' });
    });
    var app                 = express();
    app.use(bodyParser.urlencoded({ extended: true }));
    app.use(bodyParser.json());
    app.all('/', function(req, res, next) {
        res.header("Access-Control-Allow-Origin", "*");
        res.header("Access-Control-Allow-Headers", "X-Requested-With");
        next();
    });
    var port = process.env.PORT || 8080;        
    app.use('/api', router);
    app.listen(port);
    console.log('Magic happens on port ' + port);
  }
}).start();


