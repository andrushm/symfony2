<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
       // die(var_dump(base64_decode('PHA+TGllYmVyIE1pbGsgdGhlIFN1biBOdXR6ZXIsPGJyPjxicj4gU2llICsvIGhhYmVuIEloc mUgUmVnaXN0cmllcnVuZyBiZWkgTWlsayB0aGUgU3VuIG5vY2ggbmljaHQgdm9sbHN0w6RuZG lnIGFiZ2VzY2hsb3NzZW4uIEJpdHRlIGtsaWNrZW4gU2llIGF1ZiBmb2xnZW5kZW4gTGluayB vZGVyIGtvcGllcmVuIFNpZSBkaWVzZW4gaW4gZGllIEFkcmVzc3plaWxlIElocmVzIEJyb3dz ZXJzIHVtIGRpZSBBa3RpdmllcnVuZyBqZXR6dCBhYnp1c2NobGllw59lbjo8YnI+PGJyPiAgP GJyPjxicj4gVmllbGVuIERhbmssICA8YnI+IElociBNaWxrIHRoZSBTdW4gVGVhbSA8YnI+PG JyPiBfX19fX19fXzxiciAvPg0KPGJyIC8+DQo8YnI+IDxicj48c3BhbiBzdHlsZT0iZm9udC1 zaXplOiA4cHQ7IiBfbWNlX3N0eWxlPSJmb250LXNpemU6IDhwdDsiPk1pbGsgdGhlIFN1biBH bWJIIHwgTWVuZGVsc3RyYcOfZSAxMSB8IDQ4MTQ5IE3DvG5zdGVyPGJyPiBBbXRzZ2VyaWNod CBNw7xuc3RlciB8IEhSQiAxNDc0ODxicj4gR2VzY2jDpGZ0c2bDvGhyZXI6IFBoaWxpcHAgU2 VoZXJyLVRob3NzPGJyPiA8YSBocmVmPSJodHRwOi8vd3d3Lm1pbGt0aGVzdW4uY29tL2RldS9 pbXByZXNzdW0/dXRtX3NvdXJjZT1TeXN0ZW1tYWlsIiBfbWNlX2hyZWY9Imh0dHA6Ly93d3cu bWlsa3RoZXN1bi5jb20vZGV1L2ltcHJlc3N1bT91dG1fc291cmNlPVN5c3RlbW1haWwiPktvb nRha3Q8L2E+IHwgPGEgaHJlZj0iaHR0cDovL3d3dy5taWxrdGhlc3VuLmNvbS9kZXUvaW1wcm Vzc3VtP3V0bV9zb3VyY2U9U3lzdGVtbWFpbCIgX21jZV9ocmVmPSJodHRwOi8vd3d3Lm1pbGt 0aGVzdW4uY29tL2RldS9pbXByZXNzdW0/dXRtX3NvdXJjZT1TeXN0ZW1tYWlsIj5JbXByZXNz dW08L2E+IDxicj48L3NwYW4+PC9wPg==')));
        return $this->render('default/index.html.twig', array('name' => 'Mikhail'));
    }
}
