<template>

    <main style="display: flex;" class="container">
        <div style="flex: 1; background-image: url('../../public/salon.jpg'); background-size: cover;">
        </div>
        <div style="flex: 1; padding: 20px;">
            <h2 class="text-center">Contactez-nous</h2>
            <form>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email">
                <label for="message">Message :</label>
                <textarea id="message" name="message"></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </main>



</template>


<style>



main {
  max-width: 100%;
  margin: 40px auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}

main h2 {
  margin-top: 0;
}

form {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

label, input, textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  font-size: 16px;
  box-sizing: border-box;
  border-radius: 5px;
  border: 1px solid #ccc;
}

textarea {
  resize: none;
  height: 200px;
}

button[type="submit"] {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16;
}

</style>