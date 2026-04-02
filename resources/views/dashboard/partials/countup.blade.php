<script>
document.querySelectorAll('.count-up').forEach(el=>{
let target=+el.dataset.count,cur=0;
let step=Math.max(1,Math.floor(target/40));
let timer=setInterval(()=>{
cur+=step;
el.innerText=Math.min(cur,target);
if(cur>=target) clearInterval(timer);
},20);
});
</script>
