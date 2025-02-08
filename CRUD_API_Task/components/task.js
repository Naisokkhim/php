

const handlePost = (req, res) => { 
    const { title, description } = req.body;
    const newTask = { title, description };
    tasks.push(newTask);
    res.status(201).json(newTask);
};