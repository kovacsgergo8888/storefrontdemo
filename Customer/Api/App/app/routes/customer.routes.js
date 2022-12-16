const auth = require('../middleware/auth')
const customers = require('../controllers/customer.controller')
module.exports = app => {
  const customers = require("../controllers/customer.controller.js");
  const auth = require("../middleware/auth");

  var router = require("express").Router();

  router.post("/", customers.create);

  router.get("/", customers.findAll);

  router.post("/auth", auth, customers.auth);

  router.post("/by_email", auth, customers.getByEmail);

  router.get("/:id", auth, customers.findOne);

  router.put("/:id", customers.update);

  router.delete("/", customers.deleteAll);

  app.use('/api/customers', router);
};
