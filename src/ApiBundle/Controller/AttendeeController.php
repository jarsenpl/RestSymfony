<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\{
    JsonResponse, Request, Response
};
use DomainBundle\Entity\Attendee;

/**
 * Class AttendeeController
 * @package ApiBundle\Controller
 */
class AttendeeController extends ApiController
{
    /**
     *
     * @Rest\Get("/attendee/{id}", name="_show_attendee", defaults={"_format"="json"})
     *
     * @ApiDoc(
     *     section="Attendees",
     *     resource=true,
     *     description="Get full date about Meetup Attendee",
     *     statusCodes={
     *         200="OK"
     *     }
     * )
     * @param Attendee $attendee
     *
     * @return JsonResponse
     */
    public function getAction(Attendee $attendee)
    {
        $response = new JsonResponse(
            $this->get('jms_serializer')->serialize(
                ['attendee' => $attendee],
                'json'),
            Response::HTTP_OK, [], true
        );

        return $response;
    }

    /**
     *
     * @Rest\Post("/attendee", name="_add_attendee", defaults={"_format"="json"})
     *
     * @ApiDoc(
     *     section="Attendees",
     *     statusCodes={
     *         201="return when attendee created",
     *         400="Invalid input"
     *     },
     *     parameters={
     *          {"name"="name", "dataType"="string", "required"=true, "description"="attendee name and surname"},
     *          {"name"="email", "dataType"="string", "required"=true, "description"="attendee email"}
     *     }
     * )
     * @param Request $request
     *
     * @return JsonResponse|static
     */
    public function addAction(Request $request)
    {
        $attendee = $this->deserialize(Attendee::class, $request);

        if ($attendee instanceof Attendee === false) {
            return View::create(['errors' => $attendee], Response::HTTP_BAD_REQUEST);
        }

        $attendee = $this->get('attendee.service')->save($attendee);

        $url = $this->generateUrl(
            '_show_attendee',
            ['id' => $attendee->getId()],
            true
        );

        $response = new JsonResponse(['id' => $attendee->getId()]);
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->headers->set('Location', $url);

        return $response;
    }

    /**
     *
     * @Rest\Put("/attendee/{id}", name="_update_attendee", defaults={"_format"="json"})
     *
     * @ApiDoc(
     *     section="Attendees",
     *     statusCode={
     *         200="Updated",
     *         400="Invalid input",
     *         403="Forbidden"
     *     }
     * )
     *
     * @param Attendee $attendee
     * @param Request  $request
     *
     * @return View|JsonResponse
     */
    public function putAction(Attendee $attendee, Request $request)
    {
        $newAttendee = $this->deserialize(Attendee::class, $request);

        if ($newAttendee instanceof Attendee === false) {
            return View::create(['errors' => $newAttendee], Response::HTTP_BAD_REQUEST);
        }

        $attendee = $this->get('attendee.service')->merge($attendee, $newAttendee);

        $response = new JsonResponse(
            $this->get('jms_serializer')->serialize(
                ['attendee' => $attendee],
                'json'),
            Response::HTTP_OK, [], true
        );

        return $response;
    }

    /**
     *
     * @Rest\Delete("/attendee/{id}", name="_delete_attendee", defaults={"_format"="json"})
     *
     * @ApiDoc(
     *     section="Attendees",
     *     statusCodes={
     *         204="Deleted"
     *     }
     * )
     *
     * @param Attendee $attendee
     *
     * @Rest\View(statusCode=204)
     */
    public function deleteAction(Attendee $attendee)
    {
        $this->get('attendee.service')->remove($attendee);
    }
}
